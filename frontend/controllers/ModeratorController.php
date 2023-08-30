<?php

namespace frontend\controllers;

use common\helpers\HTML_TO_DOC;
use common\models\documents\CategoryNews;
use common\models\documents\ContentNews;
use common\models\documents\ContentNewsSearch;
use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;
use common\models\Employ;
use common\models\forms\CreateDocForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Psr\Container\NotFoundExceptionInterface;
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
use yii\web\MethodNotAllowedHttpException;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class ModeratorController extends Controller
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
        $searchModel = new MainDocumentSearch();

//        if (Yii::$app->user->identity->employ->role != Employ::MODERATOR) {
//            throw new MethodNotAllowedHttpException("Sizda ruxsat yo'q");
//
//        }
        $dataProvider = $searchModel->searchModerator($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionContent($id)
    {

        try {
            $news = ContentNews::find()->where(['status' => ContentNews::NEW, 'id' => $id])->one();

        } catch (InvalidArgumentException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return $this->render('content', [
            'content' => $news,
        ]);
    }

    public function actionSetLawyer($doc)
    {

        if (Yii::$app->request->post()) {
            $post = Yii::$app->request->post();
            $index = Yii::$app->request->post()['editableIndex'];
            $main = MainDocument::find()
                ->where(['id' => $doc])
                ->andWhere(['status' => MainDocument::EDITED])
                ->one();
            if ($main) {
                $main->user_id = (int)$post['MainDocument'][$index]['user_id'];
                $main->status = MainDocument::SIGNING;
                if (!$main->save()) {
                    return $main->errors;
                }
                return true;
            }


        }
        return false;

    }

    protected function findModel($id)
    {

        if (($model = MainDocument::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * Displays a single MainDocument model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

        }


        return $this->render('view', [
            'model' => $model
        ]);
    }


}
