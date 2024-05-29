<?php

namespace app\controllers;

use GuzzleHttp\Client;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class OfficeController extends Controller
{
    public function actionUpload()
    {
        $model = new \app\models\UploadForm();
        if (Yii::$app->request->isPost) {
            $model->file = UploadedFile::getInstance($model, 'file');
            if ($model->upload()) {
                $filePath = $model->getUploadedFilePath();
                $accessToken = $this->getAccessToken();
                $uploadUrl = $this->createUploadSession($accessToken, $model->file->name);

                $this->uploadFileToOneDrive($uploadUrl, $filePath);

                $editLink = $this->generateOfficeOnlineLink($filePath);

                return $this->asJson(['editLink' => $editLink]);
            }
        }
        return $this->asJson(['error' => 'Failed to upload file']);
    }

    protected function getAccessToken()
    {
        $config = require(Yii::getAlias('@app/config/onedrive.php'));
        $client = new Client();
        $response = $client->post('https://login.microsoftonline.com/' . $config['tenantId'] . '/oauth2/v2.0/token', [
            'form_params' => [
                'client_id' => $config['clientId'],
                'client_secret' => $config['clientSecret'],
                'grant_type' => 'client_credentials',
                'scope' => $config['scopes'],
            ],
        ]);

        $body = json_decode($response->getBody()->getContents(), true);
        return $body['access_token'];
    }

    protected function createUploadSession($accessToken, $fileName)
    {
        $client = new Client();
        $response = $client->post('https://graph.microsoft.com/v1.0/me/drive/root:/' . $fileName . ':/createUploadSession', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'item' => [
                    '@microsoft.graph.conflictBehavior' => 'rename',
                    'name' => $fileName
                ]
            ]
        ]);

        $body = json_decode($response->getBody()->getContents(), true);
        return $body['uploadUrl'];
    }

    protected function uploadFileToOneDrive($uploadUrl, $filePath)
    {
        $client = new Client();
        $fileSize = filesize($filePath);
        $chunkSize = 327680; // 320 KB chunks
        $handle = fopen($filePath, 'rb');
        $i = 0;

        while (!feof($handle)) {
            $start = $i * $chunkSize;
            $end = $start + $chunkSize - 1;
            $content = fread($handle, $chunkSize);
            $fileSize = strlen($content);

            if ($fileSize < $chunkSize) {
                $end = $start + $fileSize - 1;
            }

            $client->put($uploadUrl, [
                'headers' => [
                    'Content-Length' => $fileSize,
                    'Content-Range' => "bytes $start-$end/$fileSize",
                ],
                'body' => $content,
            ]);

            $i++;
        }

        fclose($handle);
    }

    protected function generateOfficeOnlineLink($filePath)
    {
        $editLink = 'https://view.officeapps.live.com/op/view.aspx?src=' . urlencode($filePath);
        return $editLink;
    }

    public function actionCallback()
    {
        // Implement callback logic to handle the edited document
        $editedFile = Yii::$app->request->post('file');
        // Process the edited file as needed
    }
}
