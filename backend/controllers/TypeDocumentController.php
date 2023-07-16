<?php

namespace backend\controllers;

use common\models\documents\MainDocument;
use common\models\documents\TypeDocuments;
use common\models\documents\TypeDocumentsSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * TypeDocumentController implements the CRUD actions for TypeDocuments model.
 */
class TypeDocumentController extends Controller
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
     * Lists all TypeDocuments models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TypeDocumentsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TypeDocuments model.
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
     * Creates a new TypeDocuments model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new TypeDocuments();

        if ($this->request->isPost) {
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
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TypeDocuments model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

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
     * Deletes an existing TypeDocuments model.
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
     * Finds the TypeDocuments model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return TypeDocuments the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TypeDocuments::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
