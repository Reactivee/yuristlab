<?php

use common\models\documents\MainDocument;

use kartik\editors\Summernote;
use yii\bootstrap4\ActiveForm;
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
        <? if ($model->status != MainDocument::NEW) { ?>
            <?= Html::a(' <i class="fas fa-pencil"></i> Imzolash ', ['/director/to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>
        <? } ?>
        <?= Html::a(' <i class="fas fa-backward mr-2"></i> Orqaga ', ['/director/to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ']) ?>
        <? if ($model->signed_lawyer) { ?>
            <?= Html::a(' <i class="fas fa-pencil"></i> Imzolash ', ['/director/to-finish', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>
        <? } ?>

    </div>
    <? if ($model->status == MainDocument::SIGNING) { ?>
        <div class="alert alert-fill-info" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Xujjar Imzolanmadi
        </div>
    <? } ?>

    <? if ($model->status == MainDocument::REJECTED) { ?>
        <div class="alert alert-fill-danger" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Rad etilgan
        </div>
    <? } ?>

    <? if ($model->status == MainDocument::SIGNED) { ?>
        <div class="alert alert-fill-success" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Imzolandi
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
            ],
            [
                'attribute' => 'conclusion_uz',
                'value' => function ($model) {

                    return $model->conclusion_uz;


                }
            ]

        ],
    ]);

    $form = ActiveForm::begin();
    if ($model->status == MainDocument::SIGNING) {

        echo $form->field($model, 'conclusion_uz')->textInput(['raw' => 6]);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Xulosa saqlash', ['class' => 'btn btn-success']) ?>
        </div>
    <? } ?>



    <?php ActiveForm::end(); ?>

</div>