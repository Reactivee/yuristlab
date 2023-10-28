<?php

namespace frontend\widgets;
/**
 * Created by PhpStorm.
 */


use yii\base\Widget;
use Yii;
use yii\helpers\Url;


class AllViewer extends Widget
{
    public $model;


    public function init()
    {


    }

    public function run()
    {
        return $this->render('all-view', [
            'model' => $this->model,
        ]);
    }


}