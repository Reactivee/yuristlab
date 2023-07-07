<?php

namespace frontend\controllers;

use common\helpers\HTML_TO_DOC;
use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;
use common\models\forms\CreateDocForm;
use common\widgets\TelegramBotErrorSender;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Google\Service\Drive;
use Yii;
use yii\base\InvalidArgumentException;
use yii\helpers\Url;
use yii\httpclient\Client;
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
class DocumentsController extends Controller
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
        $dataProvider = $searchModel->search($this->request->queryParams);
        Yii::$app->session->setFlash('danger', 'Ochirildi');

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

    public function actionDocEdit($id = null)
    {
        $model = new MainDocument();
        $doc = '';
        if ($this->request->post()) {
            $model->load($this->request->post());
            $dir_path = Yii::getAlias('@frontend') . '/web';

            $client = new Client();
            $response = $client->createRequest()
                ->setMethod('POST')
                ->setUrl(Url::base('http') . '/api/docs/uploadnew')
                ->addFile('file', $dir_path . $model->path)
                ->send();
//        return $response;
            if ($response->isOk) {
                $doc = json_decode($response->content);

                TelegramBotErrorSender::widget(['error' => $response->content, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

            }

        }
        return $this->render('doc-edit', [
            'model' => $model,
            'doc' => $doc->id
        ]);

    }

    public function actionDrive($id, $path)
    {

        $fileCredentialsPath = Yii::getAlias('@api') . '/config/creds.json';

        $savePathDocs = Yii::getAlias('@frontend') . '/web/uploads/docs/';
        if (!file_exists($savePathDocs)) {
            mkdir($savePathDocs, 0777, true);
        }

        $doc_id = $id;


        TelegramBotErrorSender::widget(['error' => $doc_id, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

        $client = new \Google\Client();
        $client->setAuthConfig($fileCredentialsPath);
        $client->addScope(Drive::DRIVE);
        $client->setAccessType('offline');
        $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
        $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
        $client->setAccessToken($accessToken);

        try {
            $service = new Drive($client);
            $savePathFromDrive = $savePathDocs . $path . '.docx';
            $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            $exportFileContent = $service->files->export($doc_id, $exportMimeType, array('alt' => 'media'));
            $fileContent = $exportFileContent->getBody()->getContents();

        } catch (\Exception $e) {
            TelegramBotErrorSender::widget(['error' => $e, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

        }

        // Save the file to a local directory
        $localFilePath = $savePathFromDrive;
        $res = file_put_contents($localFilePath, $fileContent);
        if ($res) {
            Yii::$app->session->setFlash('success', "Xujjat Saqlandi");
            return $this->redirect(Yii::$app->request->referrer);
        }
        TelegramBotErrorSender::widget(['error' => $localFilePath, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);
    }
}
