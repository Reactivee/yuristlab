<?php

namespace frontend\controllers;


use common\models\documents\MainDocument;
use common\models\documents\MainDocumentSearch;
use common\models\EmploySearch;
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
        $user_id = Yii::$app->user->identity->employ->id;

        if ($this->request->isPost && $model->load($this->request->post())) {
            if ($model->save())
                Yii::$app->session->setFlash('success', 'Saqlandi');
        }
        if (!$model->user_id)
            $model->user_id = $user_id;
        $model->save();
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

}
