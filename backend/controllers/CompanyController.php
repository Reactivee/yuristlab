<?php

namespace backend\controllers;

use common\models\Company;
use common\models\CompanySearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * CompanyController implements the CRUD actions for Company model.
 */
class CompanyController extends Controller
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
     * Lists all Company models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CompanySearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Company model.
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
     * Creates a new Company model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Company();

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {

                $doc = $model->template_doc = UploadedFile::getInstance($model, 'template_doc');

                if ($doc) {
                    $folder = Yii::getAlias('@frontend') . '/web/uploads/templates/';
                    if (!file_exists($folder)) {
                        mkdir($folder, 0777, true);
                    }
                    $generateName = Yii::$app->security->generateRandomString();
                    $path = $folder . $generateName . '.' . $doc->extension;

                    $doc->saveAs($path);
                    $path = '/uploads/templates/' . $generateName . '.' . $doc->extension;
                    $model->template_doc = $path;
                }
                if ($model->save()) {
                    Yii::$app->session->setFlash('success', 'Saqlandi');
                } else {
                    Yii::$app->session->setFlash('error', 'Xatolik');
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
     * Updates an existing Company model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        $oldPath = $model->template_doc;
        $oldLogo = $model->logo;

        if ($this->request->isPost && $model->load($this->request->post())) {

//            $doc = $model->template_doc = UploadedFile::getInstance($model, 'template_doc');
            $logo = $model->logo = UploadedFile::getInstance($model, 'logo');

            if ($logo) {
//                $folder = Yii::getAlias('@frontend') . '/web/uploads/templates/';
                $logo_folder = Yii::getAlias('@frontend') . '/web/uploads/logo/';
                if (!file_exists($logo_folder)) {
//                    mkdir($folder, 0777, true);
                    mkdir($logo_folder, 0777, true);
                }
                $generateName = Yii::$app->security->generateRandomString();
//                $path = $folder . $generateName . '.' . $doc->extension;
                $logo_path = $logo_folder . $generateName . '.' . $logo->extension;

//                $doc->saveAs($path);
                $logo->saveAs($logo_path);
//                $path = '/uploads/templates/' . $generateName . '.' . $doc->extension;
                $logo_path = '/uploads/logo/' . $generateName . '.' . $logo->extension;
//                $model->template_doc = $path;
                $model->logo = $logo_path;
            } else {
//                $model->template_doc = $oldPath;
                $model->logo = $oldLogo;
            }
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Saqlandi');
            } else {
                Yii::$app->session->setFlash('error', 'Xatolik');
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Company model.
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
     * Finds the Company model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Company the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Company::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
