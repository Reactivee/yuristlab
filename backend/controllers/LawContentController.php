<?php

namespace backend\controllers;

use common\models\news\LawContent;
use common\models\news\LawContentSearch;
use common\models\news\LawNews;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LawContentController implements the CRUD actions for LawContent model.
 */
class LawContentController extends Controller
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
     * Lists all LawContent models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new LawContentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
//        dd($category);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LawContent model.
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
     * Creates a new LawContent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new LawContent();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $doc = $model->image = UploadedFile::getInstance($model, 'image');

                if ($doc) {
                    $folder = Yii::getAlias('@frontend') . '/web/uploads/law_docs/';
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }
                    $generateName = Yii::$app->security->generateRandomString();
                    $path = $folder . $generateName . '.' . $doc->extension;

                    $doc->saveAs($path);
                    $path = '/uploads/law_docs/' . $generateName . '.' . $doc->extension;
                    $model->image = $path;
                }
                if (!$model->save()) {
                    dd($model->errors);
                }

                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing LawContent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post())) {

            $doc = $model->image = UploadedFile::getInstance($model, 'image');

            if ($doc) {
                $folder = Yii::getAlias('@frontend') . '/web/uploads/law_docs/';
                if (!file_exists($folder)) {
                    mkdir($folder, 0777, true);
                }
                $generateName = Yii::$app->security->generateRandomString();
                $path = $folder . $generateName . '.' . $doc->extension;

                $doc->saveAs($path);
                $path = '/uploads/law_docs/' . $generateName . '.' . $doc->extension;
                $model->image = $path;
            }
            if ($model['oldAttributes']['image'] && !$doc) {
                $model->image = $model['oldAttributes']['image'];
            }
            if (!$model->save()) {
                dd($model->errors);
            }
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing LawContent model.
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
     * Finds the LawContent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return LawContent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LawContent::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
