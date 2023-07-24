<?php

use common\models\documents\MainDocument;
use common\models\Employ;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Documents';

?>
<div class="container-fluid m-4 pr-5">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
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
                'label' => 'Xujjat kodi',
            ],

            'name_uz',
//            'name_ru',
            [
                'attribute' => 'category_id',
                'label'=>'Bo\'lim',
                'value' => function ($model) {

                    return $model->category->group->name_uz;
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
                'label' => 'Kategoriya',
                'value' => function ($model) {
                    return $model->subCategory->name_uz;
                }
            ],

            [
                'attribute' => 'type_group_id',
                'label' => 'Turkumi',
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

                        if ($model->user_id) {
                            $emp = Employ::findOne($model->user_id);
                            return Html::a($emp->first_name . ' ' . $emp->last_name, [$url], ['class' => 'btn btn-inverse-warning btn-fw']);
                        } else {
                            return Html::a('Tahrirlash', [$url], ['class' => 'btn btn-inverse-secondary btn-fw']);
                        }

                    }
                ],
//                'urlCreator' => function ($action, MainDocument $model, $key, $index, $column) {
//                    return Url::toRoute([$action, 'id' => $model->id]);
//                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>