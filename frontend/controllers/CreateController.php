<?php

namespace frontend\controllers;

use common\helpers\HTML_TO_DOC;
use common\models\documents\MainDocument;
use common\models\forms\CreateDocForm;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Google\Client;
use Google\Service\Docs;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Ramsey\Uuid\Uuid;
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
    public function actionUpload()
    {
        $request = \Yii::$app->request;

        if ($request->isGet) {
            return 'GET request not found!';
        }

        if ($request->isPost) {
//            $file = UploadedFile::getInstanceByName('file');
            $file = $this->request->post()['file'];

            $savePathDocs = Yii::$app->params['savePathDocs'];;
            $savePathDocsUpload = Yii::$app->params['savePathDocsUpload'];
            $fileCredentials = Yii::$app->params['fileCredentials'];
            $fileCredentialsPath = Yii::$app->params['fileCredentialsPath'];
            $fileToken = Yii::$app->params['fileToken'];
            $fileTokenPath = Yii::$app->params['fileTokenPath'];


            $client = new Client();
            $client->setAuthConfig($fileCredentialsPath);
            $client->addScope(Drive::DRIVE);
            $client->addScope(Docs::DOCUMENTS);
            $client->setAccessType('offline');
            $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
            $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $client->setAccessToken($accessToken);

            if ($file !== null) {
                $fileName = uniqid() . '.' . $file->getExtension();
                $fileSavePath = $savePathDocsUpload . $fileName;
                $file->saveAs($fileSavePath);
                $originalFileName = $file->baseName;

                // Create document
                $service = new Drive($client);
                $docsService = new Docs($client);

                $fileMetadata = new DriveFile([
                    'name' => $originalFileName,
                    'mimeType' => 'application/vnd.google-apps.document',
                ]);

                // Upload the file to Google Drive
                $file = $service->files->create($fileMetadata, [
                    'data' => file_get_contents($fileSavePath),
                    'uploadType' => 'multipart',
                ]);

                // Get the ID of the uploaded file
                $fileId = $file->getId();
//                $fileSize = $file->getSize();

                // Watching create document to updating in server
                $channel = new \Google_Service_Drive_Channel([
                    'id' => Uuid::uuid4()->toString(),
                    'type' => 'web_hook',
                    'address' => 'https://demo.alfatechno.uz/api/docs/notification?doc_id=' . $fileId,
                ]);

                $watchRequest = $service->changes->watch($fileId, $channel);
                $channelId = $watchRequest->getId();
                $expiration = $watchRequest->getExpiration();

                // Download file from  driv     e
                $savePathFromDrive = $savePathDocs . $fileId . '.docx';
                $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $exportFileContent = $service->files->export($fileId, $exportMimeType, array('alt' => 'media'));
                $fileContent = $exportFileContent->getBody()->getContents();

                // Save the file to a local directory
                $localFilePath = $savePathFromDrive;
                file_put_contents($localFilePath, $fileContent);
                dd($localFilePath);
//                $httpClient = new \GuzzleHttp\Client();
//                $permissionUrl = 'https://docs.googleapis.com/v1/documents/' . $fileId . ':batchUpdate';
//                $permissionRequestBody = [
//                    'requests' => [
//                        [
//                            'createPermission' => [
//                                'role' => 'writer',
//                                'type' => 'anyone',
//                            ],
//                        ],
//                    ],
//                ];
//
//                $httpClient->post($permissionUrl, [
//                    'headers' => [
//                        'Authorization' => 'Bearer ' . $accessToken['access_token'],
//                        'Content-Type' => 'application/json',
//                    ],
//                    'json' => $permissionRequestBody,
//                ]);

                return [
                    'id' => $fileId,
                    'path' => $savePathFromDrive,
                ];
                return [
                    'status' => 200,
                    'data' => 'UPLOAD_SUCCESSFULLY'
                ];

            } else {
                return [
                    'status' => 200,
                    'data' => 'FILE_INVALID'
                ];
            }

            return 'POST Request Method not found!';
        }

        return 'This Request Method not found!';
    }


}
