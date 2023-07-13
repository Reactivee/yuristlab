<?php

namespace frontend\controllers;


use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


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
        if ($this->request->isPost && $model->load($this->request->post())) {


        }

        return $this->render('view', [
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
        $model = MainDocument::find()->where(['status' => MainDocument::SIGNING, 'id' => $id])->one();

        if ($model) {
            $model->status = MainDocument::REJECTED;

            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Imzolandi');
                return $this->redirect(Yii::$app->request->referrer);

            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');

    }
}
