<?php

namespace frontend\controllers;


use common\models\news\LawContent;
use common\models\news\LawNewsSearch;

use yii\base\InvalidArgumentException;

use yii\web\Controller;

use yii\web\NotFoundHttpException;


/**
 * Site controller
 */
class LawNewsController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new LawNewsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionContent($id)
    {

        try {
            $news = LawContent::find()->where(['status' => 1, 'id' => $id])->one();

        } catch (InvalidArgumentException $e) {
            throw new NotFoundHttpException($e->getMessage());
        }

        return $this->render('content', [
            'content' => $news,
        ]);
    }


}
