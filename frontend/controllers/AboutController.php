<?php

namespace frontend\controllers;

use common\models\EmploySearch;
use yii\web\Controller;


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

}
