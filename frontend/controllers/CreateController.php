<?php

namespace frontend\controllers;

use common\helpers\HTML_TO_DOC;
use common\models\documents\MainDocument;
use common\models\forms\CreateDocForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class CreateController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
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
        $form = new CreateDocForm();
        $model = new MainDocument();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            $doc = $model->path = UploadedFile::getInstance($model, 'path');

            if ($doc) {
                $folder = Yii::getAlias('@frontend') . '/web/uploads/docs/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $generateName = Yii::$app->security->generateRandomString();
                $path = $folder . $generateName . '.' . $doc->extension;
                $doc->saveAs($path);
                $path = '/uploads/docs/' . $generateName . '.' . $doc->extension;
                $model->path = $path;
                $model->status = MainDocument::NEW;
                dd(Yii::$app->request->post());
            }
            if (!$model->save()) {
                Yii::$app->session->setFlash('error', 'Xatolik');
                return $this->refresh();

            }
            $files = $model->saveFiles();

            if ($files) {
                Yii::$app->session->setFlash('success', 'Yuborildi');
                return $this->refresh();

            }

        }

        return $this->render('index', [
            'model' => $form,
            'main' => $model
        ]);

    }

    public function actionUploadDocs()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $data = [];

        if ($file_image = UploadedFile::getInstancesByName('attached')) {

            foreach ($file_image as $file) {

                $folder = '/web/uploads/docs/';
                $uploads_folder = Yii::getAlias('@frontend') . $folder;
                if (!file_exists($uploads_folder)) {
                    mkdir($uploads_folder, 0777, true);
                }
                $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                $name = pathinfo($file->name, PATHINFO_FILENAME);
                $generateName = Yii::$app->security->generateRandomString();
                $path = $uploads_folder . $generateName . ".{$ext}";
                $file->saveAs($path);

                $data = [
                    'generate_name' => $generateName,
                    'name' => $name,
                    'path' => Yii::getAlias('@uploadsUrl') . $folder . $generateName . $ext
                ];

            }
        }

        return $data;
    }



}
