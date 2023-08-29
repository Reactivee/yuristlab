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
//        'floatPageSummary' => true, // floats page summary to bottom
//        'headerContainer' => ['class' => 'kv-table-header', 'style' => 'top:50px'], // offset from top
//        'resizableColumns' => true,
//        'showPageSummary' => false,

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
            'name_uz',

            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'label' => 'Bo\'lim',
                'value' => function ($model) {
                    $font = "<span class='font-weight-bold'>" . $model->group->name_uz . " </span>";
                    return $font;
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

            [
                'attribute' => 'created_at',
                'contentOptions' => ['style' => 'max-width: 100px;'],

                'value' => function ($model) {
                    return date('d-M-Y H:i:s', $model->created_at);
                },
            ],
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