<?php

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

    <?= GridView::widget([
        'pager' => [
//            'firstPageLabel' => 'Bosh',
//            'lastPageLabel' => 'Oxiri',
            'class' => '\yii\widgets\LinkPager',
        ],
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
//        'floatPageSummary' => true, // floats page summary to bottom
//        'headerContainer' => ['class' => 'kv-table-header', 'style' => 'top:50px'], // offset from top
//        'resizableColumns' => true,
//        'showPageSummary' => false,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' =>   'name_uz',
                'hAlign' => 'center',
                'format' => 'raw',
                'label' => 'Xujjat Nomi',

            ],
            [
                'attribute' => 'code_document',
                'format' => 'raw',
                'label' => 'Xujjat kodi',
                'value' => function ($model) {
                    $font = "<span class='font-weight-bold'>" . $model->code_document . " </span>";
                    return $font;
                }
            ],
//            'name_ru',
            [
                'attribute' => 'group_id',
                'label' => 'Guruh nomi',
                'format' => 'raw',
                'hAlign' => 'center',
                'width' => '200px',
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
                'contentOptions' => ['style' => 'width: 150px'],
                'value' => function ($model) {
                    return $model->group->name_uz;
                }
            ],
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'label' => 'Kategoriya',
                'hAlign' => 'center',
                'width' => '200px',
                'filter' => MainDocument::getAllCategory(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'width' => '120',
                        'multiple' => true
                    ],
                ],
                'contentOptions' => ['style' => 'width: 150px'],

                'value' => function ($model) {

                    return $model->category->name_uz;
                }
            ],

            [
                'attribute' => 'sub_category_id',
                'label' => 'Bo\'lim',
                'format' => 'raw',
                'hAlign' => 'center',
                'width' => '200px',
                'filter' => MainDocument::subAllGetCategory(),
                'filterType' => GridView::FILTER_SELECT2,
                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
//                        'width' => '120',
                        'multiple' => true
                    ],
                ],
                'value' => function ($model) {
                    return $model->subCategory->name_uz;
                }
            ],

            [
                'attribute' => 'type_group_id',
                'label' => 'Turkum',

                'format' => 'raw',
                'hAlign' => 'center',
                'width' => '200px',
                'filter' => MainDocument::subAllType(),
                'filterType' => GridView::FILTER_SELECT2,

                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
//                        'width' => '120',
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

//            'created_at:datetime',
            [
                'attribute' => 'created_at',
                'label' => 'Yaratilgan sana',

                'contentOptions' => ['style' => 'max-width: 200px;'],
                'hAlign' => 'center',
                'width' => '500px',
                'value' => function ($model) {
                    return date('d-M-Y H:i:s', $model->created_at);
                },
            ],
          //            'updated_at:datetime',
            [
                'attribute' => 'status',
                'format' => "raw",
                'hAlign' => 'center',
                'width' => '500px',
                'filter' => MainDocument::getStatusNameArr(),
                'filterType' => GridView::FILTER_SELECT2,

                'filterWidgetOptions' => [
                    'theme' => Select2::THEME_BOOTSTRAP,
                    'options' => ['prompt' => ''],
                    'pluginOptions' => [
                        'allowClear' => true,
//                        'width' => '180',
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
                        $user = Yii::$app->user->identity->employ->role;
//                        dd($user);
                        if ($user == Employ::LAWYER) {
                            $url = '/lawyer/view/' . $key;
                        }

                        if ($user == Employ::MODERATOR) {
                            $url = '/moderator/view/' . $key;
                        }

                        return Html::a('<i class="fa fa-pencil mr-1"></i>Tahrirlash', [$url], ['class' => 'btn btn-inverse-secondary btn-fw']);

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