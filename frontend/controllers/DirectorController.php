<?php

namespace frontend\controllers;


use common\models\documents\AttachedDocument;
use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class DirectorController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {

        $searchModel = new MainDocumentSearch();
        $dataProvider = $searchModel->searchDirector($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    protected function findModel($id)
    {

        if (($model = MainDocument::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionView($id)
    {
        $model = $this->findModel($id);
        $files = AttachedDocument::find()
            ->where(['main_document_id' => $id])
            ->select(['id', 'path'])
            ->all();
        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save())
                Yii::$app->session->setFlash('success', 'Saqlandi');
        }

        return $this->render('view', [
            'files' => $files,
            'model' => $model,
        ]);
    }

    public function actionToSign($id)
    {
        $main = MainDocument::find()
            ->where(['id' => $id])
            ->one();

        if ($main) {
            $main->status = MainDocument::BOSS_SIGNED;
            $main->step = MainDocument::STEP_EMPLOYER;

            if ($main->save()) {
                Yii::$app->session->setFlash('success', "Yuborildi");
                return $this->redirect(Yii::$app->request->referrer);
            }

        } else {
            Yii::$app->session->setFlash('error', "Xujjat topilmadi");
            return $this->redirect(Yii::$app->request->referrer);
        }

        Yii::$app->session->setFlash('error', "Yuborishda xatolik");
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionToFinish($id)
    {
        $main = MainDocument::find()->where(['id' => $id])->one();

        if ($main) {
            $main->status = MainDocument::BOSS_SIGNED;
            $main->step = MainDocument::STEP_EMPLOYER;

            if ($main->signed_lawyer)
                $main->step = MainDocument::STEP_BOSS_FINISH;

            if (!$main->save()) {
                dd($main->errors);

            }
            Yii::$app->session->setFlash('success', "Yuborildi");
            return $this->redirect(Yii::$app->request->referrer);

        } else {
            Yii::$app->session->setFlash('error', "Xujjat topilmadi");
            return $this->redirect(Yii::$app->request->referrer);
        }

//        Yii::$app->session->setFlash('success', "Yuborishda xatolik");
//        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionToResign($id)
    {
        $model = MainDocument::find()->where(['id' => $id])->one();

        if ($model) {
            $model->status = MainDocument::NEW;

            if ($model->save()) {
                Yii::$app->session->addFlash('success', 'Rad etildi');
                return $this->redirect(Yii::$app->request->referrer);
            }else{
                Yii::$app->session->addFlash('error', 'Xatolik !');
                return $this->redirect(Yii::$app->request->referrer);
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
