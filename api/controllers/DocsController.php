<?php

namespace api\controllers;

use common\widgets\TelegramBotErrorSender;
use Google\Client;
use Google\Service\Docs;
use Google\Service\Drive;
use Google\Service\Drive\DriveFile;
use Ramsey\Uuid\Uuid;
use Yii;
use yii\helpers\FileHelper;
use yii\rest\Controller;
use yii\web\UploadedFile;


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

            // Add permissions
            $permission = new Drive\Permission();
            $permission->setRole('writer');
            $permission->setType('anyone');

            $service->permissions->create($documentId, $permission);

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
            $savePathDocs = Yii::getAlias('@frontend') . '/web/uploads/docs/';
            if (!file_exists($savePathDocs)) {
                mkdir($savePathDocs, 0777, true);
            }

            $savePathDocsUpload = Yii::getAlias('@frontend') . '/web/uploads/docs_uploads/';

            if (!file_exists($savePathDocsUpload)) {
                mkdir($savePathDocsUpload, 0777, true);
            }

//            $fileCredentials = Yii::$app->params['fileCredentials'];
            $fileCredentialsPath = Yii::$app->params['fileCredentialsPath'];
//            $fileToken = Yii::$app->params['fileToken'];
//            $fileTokenPath = Yii::$app->params['fileTokenPath'];


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

                // Download file from  drive
                $savePathFromDrive = $savePathDocs . $fileId . '.docx';
                $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $exportFileContent = $service->files->export($fileId, $exportMimeType, array('alt' => 'media'));
                $fileContent = $exportFileContent->getBody()->getContents();

                // Save the file to a local directory
                $localFilePath = $savePathFromDrive;
                file_put_contents($localFilePath, $fileContent);

                // Add permissions
                $permission = new Drive\Permission();
                $permission->setRole('writer');
                $permission->setType('anyone');

                $service->permissions->create($fileId, $permission);

                return [
                    'id' => $fileId,
                    'path' => $savePathFromDrive,
                ];
//                return [
//                    'status' => 200,
//                    'data' => 'UPLOAD_SUCCESSFULLY'
//                ];

            } else {
                return false;
            }

            return 'POST Request Method not found!';
        }

        return 'This Request Method not found!';
    }

    public function actionAll()
    {
        $request = \Yii::$app->request;

        if ($request->isGet) {

            $savePathDocs = Yii::getAlias('@frontend') . '/web/uploads/docs/';
            if (!file_exists($savePathDocs)) {
                mkdir($savePathDocs, 0777, true);
            }
//            dd($savePathDocs);
            $savePathDocsUpload = Yii::getAlias('@frontend') . '/web/uploads/docs_uploads/';

            if (!file_exists($savePathDocsUpload)) {
                mkdir($savePathDocsUpload, 0777, true);
            }


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
//        return false;

        $request = \Yii::$app->request;
//        $savePathDocs = Yii::$app->params['savePathDocs'];;
        $fileCredentialsPath = Yii::$app->params['fileCredentialsPath'];

        $savePathDocs = Yii::getAlias('@frontend') . '/web/uploads/docs/';
        if (!file_exists($savePathDocs)) {
            mkdir($savePathDocs, 0777, true);
        }
//        dd($savePathDocs);

//            dd($savePathDocs);
//        $fileCredentialsPath = Yii::getAlias('@frontend') . '/web/uploads/docs_uploads/';

//        if (!file_exists($fileCredentialsPath)) {
//            mkdir($fileCredentialsPath, 0777, true);
//        }

//        TelegramBotErrorSender::widget(['error' => Yii::$app->request->get(), 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);
//        dd($fileCredentialsPath);
//        TelegramBotErrorSender::widget(['error' => $request, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

        if ($request->isGet) {
            $queryParams = Yii::$app->request->get();
            $doc_id = Yii::$app->request->get('doc_id');
            $org_name = Yii::$app->request->get('org');

            TelegramBotErrorSender::widget(['error' => $doc_id . '//' . $org_name, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

            $client = new Client();
            $client->setAuthConfig($fileCredentialsPath);
            $client->addScope(Drive::DRIVE);
            $client->setAccessType('offline');
            $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
            $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $client->setAccessToken($accessToken);
            try {
                $service = new Drive($client);
                $savePathFromDrive = $savePathDocs . $doc_id . '.docx';
                TelegramBotErrorSender::widget(['error' => $savePathFromDrive, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

                $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $exportFileContent = $service->files->export($doc_id, $exportMimeType, array('alt' => 'media'));
                $fileContent = $exportFileContent->getBody()->getContents();
            } catch (\Exception $e) {
                TelegramBotErrorSender::widget(['error' => $e, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

            }


            // Save the file to a local directory
            $localFilePath = $savePathFromDrive;
            file_put_contents($localFilePath, $fileContent);
            TelegramBotErrorSender::widget(['error' => $fileContent, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

//            TelegramBotErrorSender::widget(['error' => $localFilePath, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);
//            TelegramBotErrorSender::widget(['error' => $fileContent, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

            return 'GET request processed!';
        }

        if ($request->isPost) {

            $queryParams = Yii::$app->request->get();
            $doc_id = Yii::$app->request->get('doc_id');
            $org_name = Yii::$app->request->get('org');

            TelegramBotErrorSender::widget(['error' => $doc_id . '//' . $org_name, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

            $client = new Client();
            $client->setAuthConfig($fileCredentialsPath);
            $client->addScope(Drive::DRIVE);
            $client->setAccessType('offline');
            $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
            $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $client->setAccessToken($accessToken);

            $service = new Drive($client);

            $savePathFromDrive = $savePathDocs . $org_name . '.docx';
            $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            $exportFileContent = $service->files->export($doc_id, $exportMimeType, array('alt' => 'media'));
            $fileContent = $exportFileContent->getBody()->getContents();

            // Save the file to a local directory
            $localFilePath = $savePathFromDrive;
            file_put_contents($localFilePath, $fileContent);

            TelegramBotErrorSender::widget(['error' => $localFilePath, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

            return 'POST request processed!';
        }


        return 'Unsupported request method!';
    }

    public function actionUploadnew()
    {
        $request = \Yii::$app->request;

        if ($request->isGet) {
            return 'GET request not found!';
        }

        if ($request->isPost) {
            $file = UploadedFile::getInstanceByName('file');

            $savePathDocs = Yii::getAlias('@frontend') . '/web/uploads/docs/';
            if (!file_exists($savePathDocs)) {
                mkdir($savePathDocs, 0777, true);
            }

            $savePathDocsUpload = Yii::getAlias('@frontend') . '/web/uploads/docs_uploads/';

            if (!file_exists($savePathDocsUpload)) {
                mkdir($savePathDocsUpload, 0777, true);
            }

//            $fileCredentials = Yii::$app->params['fileCredentials'];
            $fileCredentialsPath = Yii::$app->params['fileCredentialsPath'];
//            $fileToken = Yii::$app->params['fileToken'];
//            $fileTokenPath = Yii::$app->params['fileTokenPath'];

            $client = new Client();
            $client->setAuthConfig($fileCredentialsPath);
            $client->addScope(Drive::DRIVE);
            $client->addScope(Docs::DOCUMENTS);
            $client->setAccessType('offline');
            $refreshToken = '1//09s88IcMbMVaZCgYIARAAGAkSNwF-L9IrW9GA0k0Z6S8zUWgyEujFVJc5flyDLS6yHNtUqU4OTe78NoLRu2Lvms4_MxaDLX_m7o8';
            $accessToken = $client->fetchAccessTokenWithRefreshToken($refreshToken);
            $client->setAccessToken($accessToken);

            if ($file !== null) {
//                $fileName = uniqid() . '.' . $file->getExtension();
//                $fileSavePath = $savePathDocsUpload . $fileName;
//
//                $file->saveAs($fileSavePath);
                $originalFileName = $file->baseName;
                $originalFilePath = $savePathDocs . $originalFileName . "." . $file->getExtension();

                // Create document
                $service = new Drive($client);
//                $docsService = new Docs($client);

                $fileMetadata = new DriveFile([
                    'name' => $originalFileName,
                    'mimeType' => 'application/vnd.google-apps.document',
                ]);

                // Upload the file to Google Drive
                $file = $service->files->create($fileMetadata, [
                    'data' => file_get_contents($originalFilePath),
                    'uploadType' => 'multipart',
                ]);

                // Get the ID of the uploaded file
                $fileId = $file->getId();
                $fileName = $file->getName();
//                $fileSize = $file->getSize();

//                // Watching create document to updating in server
//                $channel = new \Google_Service_Drive_Channel([
//                    'id' => Uuid::uuid4()->toString(),
//                    'type' => 'web_hook',
//                    'address' => 'https://demo.alfatechno.uz/api/docs/notification?doc_id=' . $fileId . "&org=" . $originalFileName,
//                ]);
//
//                $watchRequest = $service->changes->watch($fileId, $channel);

//                $channelId = $watchRequest->getId();
//                $expiration = $watchRequest->getExpiration();

                // Download file from  drive
//                $savePathFromDrive = $savePathDocs . $fileId . '.docx';
                $savePathFromDrive = $savePathDocs . $originalFileName . '.docx';
                $exportMimeType = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
                $exportFileContent = $service->files->export($fileId, $exportMimeType, array('alt' => 'media'));
                $fileContent = $exportFileContent->getBody()->getContents();
                // Save the file to a local directory
                $localFilePath = $savePathFromDrive;
                file_put_contents($localFilePath, $fileContent);

                // Add permissions
                $permission = new Drive\Permission();
                $permission->setRole('writer');
                $permission->setType('anyone');

                $service->permissions->create($fileId, $permission);

                return [
                    'id' => $fileId,
                    'path' => $localFilePath,
                ];
//                return [
//                    'status' => 200,
//                    'data' => 'UPLOAD_SUCCESSFULLY'
//                ];

            } else {
                return false;
            }

            return 'POST Request Method not found!';
        }

        return 'This Request Method not found!';
    }

    public function actionAmo()
    {
        // Получаем данные из хука
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);
        TelegramBotErrorSender::widget(['error' => $data, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);
        dd($json);

        print_r($data);

        $res = Yii::$app->request->post();
        $request = \Yii::$app->request;


// Получаем данные из хука
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

// Функция для добавления примечания к карточке
        function add_note_to_card($event_data)
        {
            // Проверяем, получен ли хук на создание карточки
            if ($event_data['event'] == 'add') {
                $card_data = $event_data['data']['card'];
                $note_text = "Создана карточка: " . $card_data['name'] . "\n";
                $note_text .= "Ответственный: " . $card_data['responsible_user_name'] . "\n";
                $note_text .= "Время создания: " . date("Y-m-d H:i:s");
            } // Проверяем, получен ли хук на изменение карточки
            elseif ($event_data['event'] == 'update') {
                $card_data = $event_data['data']['card'];
                $note_text = "Изменения в карточке: " . $card_data['name'] . "\n";
                foreach ($card_data['custom_fields'] as $field) {
                    $note_text .= $field['name'] . ": " . $field['values'][0]['value'] . "\n";
                }
                $note_text .= "Время изменения: " . date("Y-m-d H:i:s");
            } else {
                return "Unsupported event type";
            }

            // Данные для добавления примечания
            $note_data = array(
                "element_id" => $card_data['id'],
                "element_type" => 2, // 2 - тип "карточка"
                "text" => $note_text
            );

            // Отправка запроса к API AmoCRM для добавления примечания
            $add_note_url = "https://idadajoninomjonov.amocrm.ru/api/v4/leads";
            $headers = array(
                "Authorization: Bearer yBAvKpobn8xJk9rDIJAgWfmYauaoSDHAxGZiMb50NhfvbfH9qyBIkz7J9cp1qRxG",
                "Content-Type: application/json"
            );
            $ch = curl_init($add_note_url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($note_data));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            curl_close($ch);

            if ($response) {
                return "Примечание успешно добавлено";
            } else {
                return "Ошибка при добавлении примечания";
            }
        }

// Вызываем функцию с данными из хука
        $result = add_note_to_card($data);
        echo $result;


        TelegramBotErrorSender::widget(['error' => $res, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);


    }

}
