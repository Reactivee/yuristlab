<?php

namespace backend\controllers;

use common\models\documents\ContentNews;
use common\models\documents\ContentNewsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * ContentNewsController implements the CRUD actions for ContentNews model.
 */
class ContentNewsController extends Controller
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
     * Lists all ContentNews models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ContentNewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single ContentNews model.
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
     * Creates a new ContentNews model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new ContentNews();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $file_image = $model->path = UploadedFile::getInstances($model, 'path');

                if ($file_image) {
                    $folder = '/web/uploads/news/';
                    $uploads_folder = Yii::getAlias('@frontend') . $folder;
                    if (!file_exists($uploads_folder)) {
                        mkdir($uploads_folder, 0777, true);
                    }
                    $ext = pathinfo($file_image[0]->name, PATHINFO_EXTENSION);
                    $name = pathinfo($file_image[0]->name, PATHINFO_FILENAME);

                    $generateName = Yii::$app->security->generateRandomString();
                    $path = $uploads_folder . $generateName . ".{$ext}";
                    $model->path = $folder . $generateName . ".{$ext}";
                    $file_image[0]->saveAs($path);
                }
                if ($model['oldAttributes']['path'] && !$file_image) {
                    $model->path = $model['oldAttributes']['path'];
                }

                if (!$model->save()) {
                    dd($model->errors);
                } else {
                    Yii::$app->session->addFlash('success', 'Yaratildi');
                    return $this->redirect(['index']);
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing ContentNews model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);


        if ($this->request->isPost && $model->load($this->request->post())) {

//            $file=UploadedFile::className()_ge
            $file_image = $model->path = UploadedFile::getInstances($model, 'path');
            if ($file_image) {
//                dd($file_image);

                $folder = '/web/uploads/news/';
                $uploads_folder = Yii::getAlias('@frontend') . $folder;
                if (!file_exists($uploads_folder)) {
                    mkdir($uploads_folder, 0777, true);
                }
                $ext = pathinfo($file_image[0]->name, PATHINFO_EXTENSION);
                $name = pathinfo($file_image[0]->name, PATHINFO_FILENAME);

                $generateName = Yii::$app->security->generateRandomString();
                $path = $uploads_folder . $generateName . ".{$ext}";
                $model->path = $folder . $generateName . ".{$ext}";
                $file_image[0]->saveAs($path);
            }
            if ($model['oldAttributes']['path'] && !$file_image) {
                $model->path = $model['oldAttributes']['path'];
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing ContentNews model.
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
     * Finds the ContentNews model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ContentNews the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ContentNews::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
