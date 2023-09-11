<?php

namespace frontend\controllers;


use common\models\documents\CategoryDocuments;
use common\models\documents\GroupDocuments;
use common\models\documents\MainDocument;
use common\models\documents\TypeDocuments;
use common\models\forms\CreateDocForm;

use Google\Client;
use Google\Service\Docs;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Ramsey\Uuid\Uuid;
use Yii;

use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
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
    public function actionIndex($id = null, $doc = null)
    {

        $model = new MainDocument();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

            $doc_path = $model->path;

            if ($doc_path) {

                $folder = Yii::getAlias('@frontend') . '/web/uploads/docs/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $templateFile = Yii::getAlias('@frontend') . '/web' . $doc_path;

                $content = file_get_contents($templateFile);
                $generateName = Yii::$app->security->generateRandomString() . uniqid();

//            $fileName = pathinfo($model->path, PATHINFO_FILENAME);
                $fileExt = pathinfo($model->path, PATHINFO_EXTENSION);
                $newName = $model->code_document . $generateName . '.' . $fileExt;
                $savePathDocs = $folder . $newName;

                try {
                    $res_save = file_put_contents($savePathDocs, $content);
                    $model->path = '/uploads/docs/' . $newName;

                } catch (\Exception $e) {
                    Yii::$app->session->setFlash('error', $e->getMessage());
                    return $this->redirect(Yii::$app->request->referrer);
                }
            }

            $model->status = MainDocument::NEW;

            if ($doc) {
                $model->group_id = $doc;
            }

            if (!$model->save()) {
                dd($model->errors);
//                Yii::$app->session->setFlash('error', 'Xatolik');
//                return $this->refresh();
            }

            $files = $model->saveFiles();

            if ($files) {
                Yii::$app->session->setFlash('success', 'Yuborildi');
                return $this->redirect(['/documents/view/', 'id' => $model->id]);

            }

        }

        if ($id) {
            $res = $this->actionGetFile($id);

            if ($res) {
                $model->path = $res;
            }
        }

        if ($doc) {
            $gr = GroupDocuments::findOne($doc);
            if ($gr->path)
                $model->path = $gr->path;
            $model->group_id = $gr->id;
//            dd($model);
        }


        return $this->render('index', [
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
                    'path' => $folder . $generateName . '.' . $ext
                ];

            }
        }

        return $data;
    }

    public
    function actionUpload()
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
//                dd($localFilePath);
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
//                return [
//                    'status' => 200,
//                    'data' => 'UPLOAD_SUCCESSFULLY'
//                ];

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

    public function actionGetCategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents) {
                $cat = $parents[0];
                $sub = CategoryDocuments::find()
                    ->select(['id', 'name_uz as name'])
                    ->where(['status' => 1])
                    ->andWhere(['group_id' => $cat])
                    ->asArray()
                    ->all();
                return ['output' => $sub, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];

    }


    public function actionGetSubcategory()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents) {
                $cat = $parents[0];
                $sub = CategoryDocuments::find()
                    ->select(['id', 'name_uz as name'])
                    ->where(['status' => 1])
                    ->andWhere(['parent_id' => $cat])
                    ->asArray()
                    ->all();
                return ['output' => $sub, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];

    }

    public function actionGetTypes()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents) {
                $cat = $parents[0];
                $sub = TypeDocuments::find()
                    ->select(['id', 'name_uz as name'])
                    ->where(['status' => 1])
                    ->andWhere(['category_id' => $cat])
                    ->asArray()
                    ->all();
                return ['output' => $sub, 'selected' => ''];
            }
        }

        return ['output' => '', 'selected' => ''];
    }

    public function actionGetFile($id)
    {
////        Yii::$app->response->format = Response::FORMAT_JSON;
        $doc = TypeDocuments::findOne($id);
//
        if (!$doc->path) return false;
//
//        $templateFile = Yii::getAlias('@frontend') . '/web/' . $doc->path;
//        $fileName = uniqid() . '.' . $doc->path;
//        $fileName = pathinfo($templateFile, PATHINFO_FILENAME);
//        $fileExt = pathinfo($templateFile, PATHINFO_EXTENSION);
//        $newName = $fileName . uniqid() . "." . $fileExt;
//        $content = file_get_contents($templateFile);
//        $savePathDocs = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $newName;
//
//
//        try {
//            $res_save = file_put_contents($savePathDocs, $content);
//            if ($res_save) {
        return $doc->path;
//                return '/uploads/docs/' . $newName;
//            }
//
//        } catch (\Exception $e) {
//            Yii::$app->session->setFlash('error', $e->getMessage());
//            return $this->redirect(Yii::$app->request->referrer);
//        }

    }


}
