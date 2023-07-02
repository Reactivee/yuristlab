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

    protected function findModel($id)
    {
        if (($model = MainDocument::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = MainDocument::DELETED;
        $model->save();
        Yii::$app->session->setFlash('danger', 'Ochirildi');

        return $this->redirect(['index']);
    }

    /**
     * Displays a single MainDocument model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDocView($id)
    {
        $doc = MainDocument::findOne($id);

        return $this->render('doc-view', [
            'model' => $doc
        ]);
    }

    public function actionStatistics()
    {
        $main = MainDocument::find()->all();
        return $this->render('statistics', [
            'model' => $main
        ]);
    }
}
