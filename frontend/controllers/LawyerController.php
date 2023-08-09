<?php

namespace frontend\controllers;


use common\models\documents\AttachedDocument;
use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;
use common\models\EmploySearch;
use Yii;
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
//        dd(\Yii::$app->request->post());
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

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save())
                Yii::$app->session->setFlash('success', 'Saqlandi');
        }
//        if (!$model->user_id)
//            $model->user_id = $user_id;
        $model->save();
        $files = AttachedDocument::find()
            ->where(['main_document_id' => $id])
            ->select(['id','path'])
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

            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Ijobiy xulosa');
                return $this->redirect(Yii::$app->request->referrer);

            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLawyers($slug = null)
    {

        $search = new EmploySearch();

        $dataProvider = $search->searchLawyer($this->request->queryParams);
        if ($slug)
            return $this->render('team_profile', [
                'dataProvider' => $dataProvider,
            ]);


        return $this->render('team', [
            'dataProvider' => $dataProvider,
        ]);

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

}
