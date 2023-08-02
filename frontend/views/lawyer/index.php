<?php

/** @var \common\models\documents\MainDocumentSearch $searchModel */

/** @var \common\models\documents\MainDocument $dataProvider */

use common\models\documents\MainDocument;
use common\models\Employ;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\grid\ActionColumn;

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
        'showPageSummary' => false,
        'resizableColumns' => true,
        'resizeStorageKey' => Yii::$app->user->id . '-' . date("m"),
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'responsive' => true,
        'hover' => true,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'code_document',
                'label' => 'Xujjat kodi',
            ],
//            'id',
            'name_uz',
//            'name_ru',
            [
                'attribute' => 'group_id',
                'format' => 'raw',
                'filter' => MainDocument::subAllGroup(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '180',
                        'multiple' => true
                    ],
                ],
                'contentOptions' => ['style' => 'width: 100px'],
                'value' => function ($model) {
                    return $model->category->group->name_uz;
                }
            ],
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'filter' => MainDocument::getAllCategory(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '180',
                        'multiple' => true
                    ],
                ],
                'value' => function ($model) {

                    return $model->category->name_uz;
                }
            ],

            [
                'attribute' => 'sub_category_id',
                'format' => 'raw',
                'filter' => MainDocument::subAllGetCategory(),
                'filterType' => GridView::FILTER_SELECT2,

                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '180',
                        'multiple' => true
                    ],
                ],
                'value' => function ($model) {
                    return $model->subCategory->name_uz;
                }
            ],

            [
                'attribute' => 'type_group_id',
                'format' => 'raw',
                'filter' => MainDocument::subAllType(),
                'filterType' => GridView::FILTER_SELECT2,

                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '180',
                        'multiple' => true
                    ],
                ],
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
            [
                'attribute' => 'company_id',
                'label' => 'Korxona',
                'filter' => MainDocument::getAllCompany(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '180',
                        'multiple' => true
                    ],
                ],
                'value' => function ($model) {
                    return $model->company->name_uz;
                }
            ],
//            'updated_at:datetime',
            [
                'attribute' => 'status',
                'format' => "raw",
                'filter' => MainDocument::getStatusNameArr(),
                'filterType' => GridView::FILTER_SELECT2,

                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '180',
                        'multiple' => true
                    ],
                ],
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
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>