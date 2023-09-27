<?php

namespace frontend\controllers;

use common\helpers\HTML_TO_DOC;
use common\models\Employ;
use common\models\forms\UserForm;
use common\models\user\AboutEmploy;
use common\models\user\SocialEmploy;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout',],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
            'captcha' => [
                'class' => \yii\captcha\CaptchaAction::class,
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
//        $phpWord = new \PhpOffice\PhpWord\PhpWord();
//
//// Adding a section to the document
//        $section = $phpWord->addSection();
//        $section->addText('Hello asdasd!');
//
//// Saving the document as a binary
//        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
//        $objWriter->save('hello_world.docx');

// Reading the binary contents of the file
//        $fileContents = file_get_contents('http://yurist.loc/exam.doc');
//        dd($fileContents);
//        return $fileContents;
        $search = Yii::$app->user->identity->employ;

        $post = Yii::$app->request->post();

        if ($post['hasEditable']) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $search->address = $post['address'] ?? $search->address;
            $search->desc = $post['desc'] ?? $search->desc;
            $search->age = (integer)$post['age'] ?? $search->age;
            $search->instagram = $post['instagram'] ?? $search->instagram;
            $search->telegram = $post['telegram'] ?? $search->telegram;
            $search->facebook = $post['facebook'] ?? $search->facebook;
            $search->other = $post['other'] ?? $search->other;
            if (!$search->save()) {
                dd($search->error);
            }

        }

        $form = new UserForm();
        $about = AboutEmploy::find()->where(['employ_id' => $search->id])->all();

        $social = SocialEmploy::find()->where(['employ_id' => $search->id])->all();
        if (empty($about))
            $about = [new AboutEmploy()];

//        if (Yii::$app->request->post()) {
//            $form->load(Yii::$app->request->post());
//            $form->changeUserPassword();
//        }


        return $this->render('index', [
            'models' => $search,
            'user_form' => $form,
            'about' => $about,
            'social' => $social,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'blank';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        }

        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {

        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {

            if (!$model->signup()) {
                dd($model->errors);
            }
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            }

            Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @return yii\web\Response
     * @throws BadRequestHttpException
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if (($user = $model->verifyEmail()) && Yii::$app->user->login($user)) {
            Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
            return $this->goHome();
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }

    public function actionAboutEmploy()
    {
        if (Yii::$app->request->post()) {


            $employ_id = Yii::$app->user->identity->employ;

            if (!$employ_id) return false;
            $file_image = UploadedFile::getInstances($employ_id, 'photo');

            if ($file_image) {
                foreach ($file_image as $file) {
                    $folder = '/web/uploads/employ/';
                    $uploads_folder = Yii::getAlias('@frontend') . $folder;
                    if (!file_exists($uploads_folder)) {
                        mkdir($uploads_folder, 0777, true);
                    }
                    $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                    $name = pathinfo($file->name, PATHINFO_FILENAME);
                    $generateName = Yii::$app->security->generateRandomString();
                    $path = $uploads_folder . $generateName . ".{$ext}";
                    $file->saveAs($path);
                    $employ_id->photo = '/uploads/employ/' . $generateName . ".{$ext}";
                }
            } else {
                $old_photo = $employ_id->oldAttributes['photo'];
                $employ_id->photo = $old_photo;
            }

            $posts = Yii::$app->request->post()['AboutEmploy'];
            $hobby = Yii::$app->request->post()['Employ'];

            if ($posts) {
                $about = AboutEmploy::find()->where(['employ_id' => $employ_id->id])->all();
                $oldIDs = ArrayHelper::map($about, 'id', 'id');
                $deleted = AboutEmploy::deleteAll(['id' => $oldIDs]);
                foreach ($posts as $key => $item) {
                    if (isset($item['name_uz'])) {
                        $new_info = new AboutEmploy();
                        $new_info->key = $item['key'];
                        $new_info['name_uz'] = $item['name_uz'];
                        $new_info['text_uz'] = $item['text_uz'];
                        $new_info->employ_id = $employ_id->id;
                        $new_info->save();
                    }
                }
            }

            $employ_id->hobby = $hobby['hobby'];

            if ($employ_id->save()) {
                Yii::$app->session->setFlash('success', 'Saqlandi');
            } else {
                Yii::$app->session->setFlash('error', 'Xatolik');
            }

            return $this->redirect(Yii::$app->request->referrer);

        }
        return false;

    }
}
