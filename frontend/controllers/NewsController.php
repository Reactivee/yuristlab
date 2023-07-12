<?php

namespace frontend\controllers;

use common\helpers\HTML_TO_DOC;
use common\models\documents\CategoryNews;
use common\models\documents\ContentNews;
use common\models\documents\ContentNewsSearch;
use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;
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
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;

/**
 * Site controller
 */
class NewsController extends Controller
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
        $searchModel = new ContentNewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
//        Yii::$app->session->setFlash('danger', 'Ochirildi');
        $cats = CategoryNews::find()->where(['status' => 1])->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $cats
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


}
