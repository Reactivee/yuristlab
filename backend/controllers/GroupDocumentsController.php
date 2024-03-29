<?php

namespace backend\controllers;

use common\models\documents\GroupDocuments;
use common\models\documents\GroupDocumentsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GroupDocumentsController implements the CRUD actions for GroupDocuments model.
 */
class GroupDocumentsController extends Controller
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
     * Lists all GroupDocuments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GroupDocumentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single GroupDocuments model.
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
     * Creates a new GroupDocuments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new GroupDocuments();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                if ($model->load($this->request->post())) {
                    $doc = $model->path = UploadedFile::getInstance($model, 'path');

                    if ($doc) {
                        $folder = Yii::getAlias('@frontend') . '/web/uploads/templates/';
                        if (!file_exists($folder)) {
                            mkdir($folder, 0777, true);
                        }
                        $generateName = Yii::$app->security->generateRandomString();
                        $path = $folder . $generateName . '.' . $doc->extension;

                        $doc->saveAs($path);
                        $path = '/uploads/templates/' . $generateName . '.' . $doc->extension;
                        $model->path = $path;

                    }
                    if ($model->save()) {
                        Yii::$app->session->setFlash('success', 'Saqlandi');
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                }

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
     * Updates an existing GroupDocuments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $oldPath = $model->path;
        if ($this->request->isPost && $model->load($this->request->post())) {
            $doc = $model->path = UploadedFile::getInstance($model, 'path');

            if ($doc) {
                $folder = Yii::getAlias('@frontend') . '/web/uploads/templates/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $generateName = Yii::$app->security->generateRandomString();
                $path = $folder . $generateName . '.' . $doc->extension;

                $doc->saveAs($path);
                $path = '/uploads/templates/' . $generateName . '.' . $doc->extension;
                $model->path = $path;
            } else {
                $model->path = $oldPath;
            }

            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saqlandi');
                return $this->redirect(['view', 'id' => $model->id]);

            }

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing GroupDocuments model.
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
     * Finds the GroupDocuments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return GroupDocuments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = GroupDocuments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
