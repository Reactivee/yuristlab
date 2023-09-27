<?php

namespace frontend\controllers;


use common\models\documents\AttachedDocument;
use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;
use common\models\Employ;
use common\models\EmploySearch;
use common\models\forms\UserForm;
use common\models\user\AboutEmploy;
use common\widgets\TelegramBotErrorSender;
use Google\Service\Drive;
use Yii;
use yii\base\Model;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\httpclient\Client;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * Site controller
 */
class LawyerController extends Controller
{


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new MainDocumentSearch();

        $dataProvider = $searchModel->searchLawyer($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $user_id = Yii::$app->user->identity->employ->id;
//        dd($this->request->post());
        $post = $this->request->post();
        if ($this->request->isPost && $model->load($post)) {

            if ($model->save())
                Yii::$app->session->setFlash('success', 'Saqlandi');
        }
        if ($post['hasEditable']) {

            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            $model->conclusion_uz = $post['notes'];
            $model->save();

        }

//        if (!$model->user_id)
//            $model->user_id = $user_id;
        $model->save();
        $files = AttachedDocument::find()
            ->where(['main_document_id' => $id])
            ->select(['id', 'path'])
            ->all();

        return $this->render('view', [
            'files' => $files,
            'model' => $model,
        ]);
    }

    protected function findModel($id)
    {

        if (($model = MainDocument::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionToResign($id)
    {
        $model = MainDocument::find()->where(['id' => $id])->one();

        if ($model) {
            $model->status = MainDocument::REJECTED;

            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Rad etildi');
                return $this->redirect(Yii::$app->request->referrer);

            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionToSign($id)
    {
//        dd('asd')
        $model = MainDocument::find()->where(['id' => $id])->one();

        if ($model) {
            $model->status = MainDocument::SUCCESS;
            $model->step = MainDocument::STEP_EMPLOYER;


            if (!$model->category && !$model->lawyer_conclusion_path) {
                Yii::$app->session->addFlash('error', 'Yuborishda xatolik/ Xujjat biriktirilmagan');
                return $this->redirect(Yii::$app->request->referrer);
            }

            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Ijobiy xulosa');
                return $this->redirect(Yii::$app->request->referrer);
            } else {
                Yii::$app->session->addFlash('error', 'Yuborishda xatolik');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLawyers()
    {

        $search = new EmploySearch();

        $dataProvider = $search->searchLawyer($this->request->queryParams);

        return $this->render('team', [
            'dataProvider' => $dataProvider,
        ]);

    }

    public function actionInfo($slug = null)
    {

        $search = Employ::find()->where(['first_name' => $slug])->one();

        $form = new UserForm();
        $about = AboutEmploy::find()->where(['employ_id' => $search->id])->all();

        if (empty($about))
            $about = [new AboutEmploy()];


        return $this->render('team_profile', [
            'models' => $search,
            'user_form' => $form,
            'about' => $about,
        ]);
    }

    public function actionUserdata()
    {
        dd(Yii::$app->request->post());
    }


    public function actionUploadConclusion($id)
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if ($file_image = UploadedFile::getInstancesByName('lawyer_conclusion_path')) {

            if ($id) {
                $main = MainDocument::findOne($id);
            }

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

                $main->lawyer_conclusion_path = '/uploads/docs/' . $generateName . ".{$ext}";
                $main->save();

            }

        }

        return $data;

    }

    public function actionDeleteConclusion()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (Yii::$app->request->post()) {
            $id = Yii::$app->request->post()['key'];
            $files = MainDocument::find()
                ->where(['id' => $id])
                ->andWhere(['not', ['status' => MainDocument::SUCCESS]])
                ->one();
            if ($files) {
                $files->lawyer_conclusion_path = '';
                if ($files->save()) return true;
            }

        }

        return false;
    }

    public function actionDocTemplate($id)
    {

        $doc = MainDocument::findOne($id);

        if (!$doc->lawyer_conclusion_path) {
            $templateFile = Yii::getAlias('@frontend') . '/web/uploads/templates/sud.docx';
            $fileName = pathinfo($templateFile, PATHINFO_FILENAME);
            $fileExt = pathinfo($templateFile, PATHINFO_EXTENSION);
            $newName = $fileName . '-' . uniqid() . "." . $fileExt;
            $content = file_get_contents($templateFile);
            $savePathDocs = Yii::getAlias('@frontend') . '/web/uploads/docs/' . $newName;

            try {
                $res_save = file_put_contents($savePathDocs, $content);

                if ($res_save) {

                    $doc->lawyer_conclusion_path = '/uploads/docs/' . $newName;
                    $doc->save();

                }
            } catch (\Exception $e) {
                Yii::$app->session->setFlash('error', $e->getMessage());
                return $this->redirect(Yii::$app->request->referrer);
            }
            Yii::$app->session->setFlash('success', 'Xujjat yuklandi');
        }

        return $this->render('doc-view', [
            'model' => $doc
        ]);
    }

    public function actionDocEdit()
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
                ->addFile('file', $dir_path . $model->lawyer_conclusion_path)
                ->send();

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

        $main_doc = MainDocument::find()->where(['lawyer_conclusion_path' => '/uploads/docs/' . $path . '.docx'])->one();

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
            return $this->redirect(['/lawyer/view/', 'id' => $main_doc->id]);
        }
        TelegramBotErrorSender::widget(['error' => $localFilePath, 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);

        Yii::$app->session->setFlash('error', "Google bilan xatolik");
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionAboutEmploy()
    {
        if (Yii::$app->request->post()) {
            $posts = Yii::$app->request->post()['AboutEmploy'];
            $employ_id = Yii::$app->user->identity->employ;

            if (!$employ_id) return false;
            $about = AboutEmploy::find()->where(['employ_id' => $employ_id->id])->all();

            $oldIDs = ArrayHelper::map($about, 'id', 'id');

            Model::loadMultiple($about, Yii::$app->request->post());
            $deleted = AboutEmploy::deleteAll(['id' => $oldIDs]);

            foreach ($posts as $key =>   $item) {
                if(isset($item['name_uz'])){
                    $new_info = new AboutEmploy();

                    $new_info->key = $item->key;
                    $new_info['name_uz'] = $item['name_uz'];
                    $new_info['text_uz'] = $item['text_uz'];
                    $new_info->employ_id = $employ_id->id;
                    $new_info->save();
                }

            }
            Yii::$app->session->setFlash('success', 'Saqlandi');
            return $this->redirect(Yii::$app->request->referrer);


//
//            $post = Yii::$app->request->post();
//            dd($post);

        }

    }

}
