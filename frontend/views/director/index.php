<?php

/** @var \common\models\documents\MainDocumentSearch $searchModel */

/** @var \common\models\documents\MainDocument $dataProvider */

use common\models\documents\MainDocument;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Documents';

?>
<div class="container-fluid m-4 pr-5">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?=
    GridView::widget([
        'pager' => [
//            'firstPageLabel' => 'Bosh',
//            'lastPageLabel' => 'Oxiri',
            'class' => '\yii\widgets\LinkPager',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'code_document',
                'format' => 'raw',
                'label' => 'Xujjat kodi',
                'value' => function ($model) {
                    $font = "<span class='font-weight-bold'>" . $model->code_document . " </span>";
                    return $font;
                }
            ],
//            'id',
            'name_uz',
//            'name_ru',
            [
                'attribute' => 'category_id',
                'label' => 'Guruh',
                'value' => function ($model) {

                    return $model->group->name_uz;
                }
            ],
            [
                'attribute' => 'category_id',
                'label' => 'Kategoriya',
                'value' => function ($model) {

                    return $model->category->name_uz;
                }
            ],

            [
                'attribute' => 'group_id',
                'label' => 'Ichki Kategoriya',
                'value' => function ($model) {
                    return $model->subCategory->name_uz;
                }
            ],

            [
                'attribute' => 'type_group_id',
                'label' => 'Turkum',

                'value' => function ($model) {
                    return $model->type->name_uz;
                }
            ],

//            'created_by',

//            [
//                'attribute' => 'path',
//                'format' => "raw",
//                'value' => function ($model) {
//                    return Html::a('Ko\'rish', $model->path);
//                }
//            ],
//            'time_begin:datetime',
//            'time_end:datetime',

            'created_at:datetime',
//            'updated_at:datetime',
            [
                'attribute' => 'status',
                'format' => "raw",
                'value' => function ($model) {
                    return MainDocument::getStatusNameColored($model->status);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('Tahrirlash', [$url], ['class' => 'btn btn-inverse-secondary btn-fw']);
                    }
                ],
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>