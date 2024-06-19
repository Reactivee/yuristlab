<?php

namespace frontend\controllers;

use common\models\EmploySearch;
use yii\web\Controller;
use common\widgets\TelegramBotErrorSender;


/**
 * Site controller
 */
class AboutController extends Controller
{


    function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTeam($slug = null)
    {

        $search = new EmploySearch();

        $dataProvider = $search->searchLawyer($this->request->queryParams);

        if ($slug)
            return $this->redirect('team_profile', [
                'models' => $dataProvider->models,
            ]);


        return $this->render('team', [
            'dataProvider' => $dataProvider,
        ]);

    }
     public function actionTg($slug = null)
    {

        
          
        TelegramBotErrorSender::widget(['error' => $this->request->post(), 'id' => [], 'where' => 'ordercounting', 'line' => __LINE__]);


    }

}
