<?php

/** @var \common\models\documents\MainDocumentSearch $searchModel */

/** @var \common\models\documents\MainDocument $dataProvider */

use common\models\documents\MainDocument;
use common\models\Employ;
use kartik\editable\Editable;
use kartik\grid\GridView;
use kartik\select2\Select2;
use yii\grid\ActionColumn;

use yii\helpers\Html;
use yii\widgets\Pjax;

$this->title = 'Documents';

?>
<div class="container-fluid m-4 pr-5">
    <!--    --><?php //Pjax::begin(); ?>
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
                    return $model->group->name_uz;
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


            [
                'attribute' => 'created_at',
                'contentOptions' => ['style' => 'max-width: 500px;'],
                'hAlign' => 'center',
                'width' => '300px',
                'value' => function ($model) {
                    return date('d-M-Y H:i:s', $model->created_at);
                },
            ],
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
                'class' => 'kartik\grid\EditableColumn',
                'attribute' => 'user_id',
                'format' => 'raw',

                'value' => function ($model) {
//                    return $model->lawyer->first_name . ' ' . $model->lawyer->last_name;

                },
//                'editableOptions' => function ($model, $key, $index) {
//                    return [
//                        'header' => 'Name',
//                        'size' => 'md',
//                        'beforeInput' => function ($form, $widget) use ($model, $index) {
////                            echo $form->field($model, "publish_date")->widget(\kartik\widgets\DatePicker::classname(), [
////                                'options' => ['id' => "publish_date_{$index}"]
////                            ]);
//                        },
//                        'afterInput' => function ($form, $widget) use ($model, $index) {
////                            echo $form->field($model, "[{$index}]color")->widget(\kartik\color\ColorInput::classname(), [
////                                'options' => ['id' => "publish_date_{$index}"]
////                            ]);
//                        }
//                    ];
//                }
                'editableOptions' => function ($model) {
                    return [
                        'submitButton' => [
                            'class' => 'btn btn-success btn-pill ',
                            'icon' => '<i class="fas fa-check"></i>',
                            'label' => 'asd',

                        ],
                        'formOptions' => ['action' => ['/moderator/set-lawyer', 'doc' => $model->id]],
                        'displayValue' => $model->user_id ? $model->lawyer->first_name . ' ' . $model->lawyer->last_name : 'Biriktirilmagan',
                        'size' => 'md',
                        'placement' => 'left',
                        'inputType' => Editable::INPUT_SELECT2,
                        'options' => [
                            'data' => Employ::getLawyers(),
                            'options' => [
                                'placeholder' => 'Yurist tanlang',
                            ],
                            'theme' => Select2::THEME_DEFAULT
                        ]
                    ];
                },
                'refreshGrid' => true,
                'hAlign' => 'left',
                'vAlign' => 'right',
                'width' => '50px',
                'pageSummary' => false
            ],
//            [
//                'attribute' => 'user_id',
//                'value' => function ($model) {
//                    return $model->lawyer->first_name . ' ' . $model->lawyer->last_name;
//                }
//            ],
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

    <!--    --><?php //Pjax::end(); ?>

</div>