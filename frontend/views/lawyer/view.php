<?php

use common\models\documents\MainDocument;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */

$this->title = $model->name_uz;
$this->params['breadcrumbs'][] = ['label' => 'Main Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$initialPreviewConfigDocs = [];
$initialPreviewConfig = [];
if (!empty($model->attach)) {
    foreach ($model->attach as $item) {

        array_push($initialPreviewConfigDocs, [
            'caption' => $item->path,
            'key' => $item->id,
            'icon' => '<i class="fa fa-arrow-circle-right"></i>',
        ]);
    }
}

?>
<div class="container-fluid p-3">
    <div class="buttons_wrap mb-3">

<!--        --><?//= Html::button(' <i class="fas fa-pencil mr-2"></i> Imzolash', ['type' => 'submit', 'class' => 'btn btn-outline-success btn-icon-text']) ?>
        <?= Html::a(' <i class="fas fa-pencil"></i> Orqaga ', ['to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-primary']) ?>
        <?= Html::a(' <i class="fas fa-backward"></i> Orqaga ', ['to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ml-3']) ?>
<!--        --><?//= Html::a(' <i class="fas fa-trash"></i> Ochirish', ['delete', 'id' => $model->id], ['class' => 'btn btn-outline-danger btn-icon-text ml-2']) ?>
    </div>
    <? if ($model->status == MainDocument::SIGNING) { ?>
        <div class="alert alert-fill-info" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Xujjar Imzlandi
        </div>
    <? } ?>
    <? if ($model->status == MainDocument::REJECTED) { ?>
        <div class="alert alert-fill-danger" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Rad etilgan
        </div>
    <? } ?>
    <? echo DetailView::widget(['model' => $model,
        'attributes' => [
            'id',
            'name_uz',
            //        'name_ru',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->name_uz;
                }
            ],

            [
                'attribute' => 'group_id',
                'value' => function ($model) {
                    return $model->subCategory->name_uz;
                }
            ],

            [
                'attribute' => 'type_group_id',
                'value' => function ($model) {
                    return $model->type->name_uz;
                }
            ],
            [
                'attribute' => 'status',
                'format' => "raw",

                'value' => function ($model) {
                    return MainDocument::getStatusNameColored($model->status);
                }
            ],
            'created_at:datetime',
            'updated_at:datetime',
            'created_by',
//            'path',
            [
                'attribute' => 'path',
                'format' => "raw",
                'label' => 'Asosiy fayl',
                'value' => function ($model) {
                    $icon = Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                        ['/documents/doc-template', 'id' => $model->id], ['target' => '_blank']);
                    $url = Html::a('Faylni ko\'rish',
                        ['/frontend/web' . $model->path], ['target' => '_blank']);
                    return $url;
                }
            ],
            [
                'attribute' => 'files',
                'format' => "raw",
                'label' => 'Qoshimcha',
                'value' => function ($model) use ($initialPreviewConfigDocs) {
                    $url = '';
                    foreach ($initialPreviewConfigDocs as $item) {
                        $url .= Html::a('<img style="width: 120px; height: 100px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                            ['/frontend' . $item['caption']], ['target' => '_blank']);
                    }

                    return $url;
                }
            ]
            // 'time_begin:datetime',
            // 'time_end:datetime',
        ],
    ]) ?>

</div>