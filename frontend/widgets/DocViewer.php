<?php

namespace common\widgets;
/**
 * Created by PhpStorm.
 */


use yii\base\Widget;
use Yii;
use yii\helpers\Url;


class DocViewer extends Widget
{
    public $model;
    public $id;
    public $where;
    public $line;

    public function init()
    {


    }

    public function run()
    {
        return $this->render('doc-view-template', [
            'model' => $this->model,
        ]);
    }


}