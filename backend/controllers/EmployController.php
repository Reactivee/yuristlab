<?php

namespace backend\controllers;

use common\models\Employ;
use common\models\EmploySearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * EmployController implements the CRUD actions for Employ model.
 */
class EmployController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Employ models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new EmploySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Employ model.
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

    /**
     * Creates a new Employ model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Employ();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $file_image = UploadedFile::getInstances($model, 'photo');
                if ($file_image) {
                    foreach ($file_image as $file) {

                        $folder = '/web/uploads/employ/';
                        $uploads_folder = Yii::getAlias('@frontend') . $folder;
                        if (!file_exists($uploads_folder)) {
                            mkdir($uploads_folder, 0777, true);
                        }
                        $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                        $name = pathinfo($file->name, PATHINFO_FILENAME);
                        $generateName = Yii::$app->security->generateRandomString();
                        $path = $uploads_folder . $generateName . ".{$ext}";
                        $file->saveAs($path);
                        $model->photo = '/uploads/employ/' . $generateName . ".{$ext}";
                    }
                }

                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Employ model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $file_image = UploadedFile::getInstances($model, 'photo');
            if ($file_image) {
                foreach ($file_image as $file) {

                    $folder = '/web/uploads/employ/';
                    $uploads_folder = Yii::getAlias('@frontend') . $folder;
                    if (!file_exists($uploads_folder)) {
                        mkdir($uploads_folder, 0777, true);
                    }
                    $ext = pathinfo($file->name, PATHINFO_EXTENSION);
                    $name = pathinfo($file->name, PATHINFO_FILENAME);
                    $generateName = Yii::$app->security->generateRandomString();
                    $path = $uploads_folder . $generateName . ".{$ext}";
                    $file->saveAs($path);
                    $model->photo = '/uploads/employ/' . $generateName . ".{$ext}";
                }
            } else {
                $old_photo = $model->oldAttributes['photo'];
                $model->photo = $old_photo;
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Employ model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Employ model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Employ the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Employ::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
