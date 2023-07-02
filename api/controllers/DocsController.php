<?php

namespace api\controllers;

use Google\Exception;
use GuzzleHttp\Exception\GuzzleException;
use PhpParser\Node\Expr\Array_;
use Yii;

use yii\rest\Controller;
use yii\web\Response;
use Google\Client;
use Google\Service\Drive;
use Google\Service\Docs;
use yii\helpers\FileHelper;
use Google\Service\Drive\DriveFile;
use Ramsey\Uuid\Uuid;
use yii\web\UploadedFile;

use GuzzleHttp\Client as HttpClient;


class DocsController extends Controller
{
    public function actionCreate()
    {
        $request = \Yii::$app->request;

        if ($request->isGet) {
            return 'GET request not found!';
        }

        if ($request->isPost) {
            $rawData = Yii::$app->request->getRawBody();
            $jsonData = json_decode($rawData, true);
            $document_title = $jsonData['title'];
            $savePathDocs = Yii::$app->params['savePathDocs'];;
            $savePathDocsUpload = Yii::$app->params['savePathDocsUpload'];

            $fileCredentials = Yii::$app->params['fileCredentials'];
            $fileCredentialsPath = Yii::$app->params['fileCredentialsPath'];
            $fileToken = Yii::$app->params['fileToken'];
            $fileTokenPath = Yii::$app->params['fileTokenPath'];

            $client = new Client();
            $client->setAuthConfig($fileCredentialsPath);
            $client->addScope(Drive::DRIVE);
            $client->setAccessType('offline');
            $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
            $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $client->setAccessToken($accessToken);

            // Create document
            $service = new Drive($client);
            $documentDetails = new DriveFile([
                'name' => $document_title,
                'mimeType' => 'application/vnd.google-apps.document',
            ]);
            $createdDocument = $service->files->create($documentDetails);
            $documentId = $createdDocument->getId();

            // Watching create document to updating in server
            $channel = new \Google_Service_Drive_Channel([
                'id' => Uuid::uuid4()->toString(),
                'type' => 'web_hook',
                'address' => 'https://api.enternaloptimist.com/notification?yii=' . $documentId,
            ]);

            $watchRequest = $service->changes->watch($documentId, $channel);
            $channelId = $watchRequest->getId();
            $expiration = $watchRequest->getExpiration();

            // Download file from  drive
            $savePathFromDrive = $savePathDocs . $documentId . '.docx';
            $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            $exportFileContent = $service->files->export($documentId, $exportMimeType, array('alt' => 'media'));
            $fileContent = $exportFileContent->getBody()->getContents();

            // Save the file to a local directory
            $localFilePath = $savePathFromDrive;
            file_put_contents($localFilePath, $fileContent);

            // Add Permission for All
            $httpClient = new \GuzzleHttp\Client();
            $permissionUrl = 'https://docs.googleapis.com/v1/documents/' . $documentId . ':batchUpdate';
            $permissionRequestBody = [
                'requests' => [
                    [
                        'createPermission' => [
                            'role' => 'writer',
                            'type' => 'anyone',
                        ],
                    ],
                ],
            ];
            $httpClient->post($permissionUrl, [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                    'Content-Type' => 'application/json',
                ],
                'json' => $permissionRequestBody,
            ]);



            return [
                'id' => $documentId,
                'channelId' => $channelId,
                'expiration' => $expiration
            ];
        }

        return 'This Request Method not found!';
    }

    public function actionEdit()
    {
        $request = \Yii::$app->request;
        if ($request->isGet) {
            return 'GET request not found!';
        }
        if ($request->isPost) {
            return 'POST Request Method not found!';
        }
        return 'This Request Method not found!';
    }

    public function actionUpload()
    {
        $request = \Yii::$app->request;

        if ($request->isGet) {
            return 'GET request not found!';
        }
        
        if ($request->isPost) {
            $file = UploadedFile::getInstanceByName('file');
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
//        dd($client);
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
                $fileSize = $file->getSize();

                // Watching create document to updating in server
                $channel = new \Google_Service_Drive_Channel([
                    'id' => Uuid::uuid4()->toString(),
                    'type' => 'web_hook',
                    'address' => 'https://demo.alfatechno/api/docs/notification?doc_id=' . $fileId,
                ]);

                $watchRequest = $service->changes->watch($fileId, $channel);
                $channelId = $watchRequest->getId();
                $expiration = $watchRequest->getExpiration();

                // Download file from  drive
                $savePathFromDrive = $savePathDocs . $fileId . '.docx';
                $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $exportFileContent = $service->files->export($fileId, $exportMimeType, array('alt' => 'media'));
                $fileContent = $exportFileContent->getBody()->getContents();

                // Save the file to a local directory
                $localFilePath = $savePathFromDrive;
                file_put_contents($localFilePath, $fileContent);

                $httpClient = new \GuzzleHttp\Client();
                $permissionUrl = 'https://docs.googleapis.com/v1/documents/' . $fileId . ':batchUpdate';
                $permissionRequestBody = [
                    'requests' => [
                        [
                            'createPermission' => [
                                'role' => 'writer',
                                'type' => 'anyone',
                            ],
                        ],
                    ],
                ];
                $httpClient->post($permissionUrl, [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $accessToken,
                        'Content-Type' => 'application/json',
                    ],
                    'json' => $permissionRequestBody,
                ]);

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

    public function actionAll()
    {
        $request = \Yii::$app->request;

        if ($request->isGet) {
            $savePathDocs = Yii::$app->params['savePathDocs'];;
            $savePathDocsUpload = Yii::$app->params['savePathDocsUpload'];
//        dd($savePathDocs);
            $files = FileHelper::findFiles($savePathDocs);

            $fileNames = [];
            foreach ($files as $file) {
                $fileName = pathinfo($file, PATHINFO_FILENAME);
                $fileNames[] = $fileName;
            }
            return $fileNames;

            return 'GET request not found!';
        }

        if ($request->isPost) {
            return 'POST Request Method not found!';
        }

        return 'This Request Method not found!';
    }

    public function actionNotification()
    {
        $request = \Yii::$app->request;
        $savePathDocs = Yii::$app->params['savePathDocs'];;
        $fileCredentialsPath = Yii::$app->params['fileCredentialsPath'];

        if ($request->isGet) {
            $queryParams = Yii::$app->request->get();
            $doc_id = Yii::$app->request->get('doc_id');

            $client = new Client();
            $client->setAuthConfig($fileCredentialsPath);
            $client->addScope(Drive::DRIVE);
            $client->setAccessType('offline');
            $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
            $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $client->setAccessToken($accessToken);

            $service = new Drive($client);

            $savePathFromDrive = $savePathDocs . $doc_id . '.docx';
            $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            $exportFileContent = $service->files->export($doc_id, $exportMimeType, array('alt' => 'media'));
            $fileContent = $exportFileContent->getBody()->getContents();

            // Save the file to a local directory
            $localFilePath = $savePathFromDrive;
            file_put_contents($localFilePath, $fileContent);

            return 'GET request processed!';
        }

        if ($request->isPost) {
            $queryParams = Yii::$app->request->get();
            $doc_id = Yii::$app->request->get('doc_id');

            $client = new Client();
            $client->setAuthConfig($fileCredentialsPath);
            $client->addScope(Drive::DRIVE);
            $client->setAccessType('offline');
            $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
            $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $client->setAccessToken($accessToken);

            $service = new Drive($client);

            $savePathFromDrive = $savePathDocs . $doc_id . '.docx';
            $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            $exportFileContent = $service->files->export($doc_id, $exportMimeType, array('alt' => 'media'));
            $fileContent = $exportFileContent->getBody()->getContents();

            // Save the file to a local directory
            $localFilePath = $savePathFromDrive;
            file_put_contents($localFilePath, $fileContent);

            return 'POST request processed!';
        }


        return 'Unsupported request method!';
    }
}
