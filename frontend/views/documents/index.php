<?php

use common\models\documents\CategoryDocuments;
use common\models\documents\MainDocument;
use common\models\documents\TypeDocuments;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;



$this->title = 'Documents';

?>
<div class="container-fluid m-4 pr-5">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'name_uz',
//            'name_ru',
            'category_id',
            'group_id',
            'status',
            'created_at:datetime',
            'updated_at:datetime',
//            'created_by',
            'path',
            'time_begin:datetime',
            'time_end:datetime',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, MainDocument $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>