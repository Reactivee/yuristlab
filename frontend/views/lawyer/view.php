<?php

use common\models\documents\MainDocument;

use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
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
        <? if ($model->status != MainDocument::SIGNED) { ?>
            <?= Html::a(' <i class="fas fa-pencil"></i> Imzolash ', ['to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>

        <? } ?>
        <!--        --><? // if ($model->status == MainDocument::SIGNED) { ?>
        <!--        --><? //= Html::button(' <i class="fas fa-pencil mr-2"></i> Imzolash', ['type' => 'submit', 'class' => 'btn btn-outline-success btn-icon-text']) ?>
        <?= Html::a(' <i class="fas fa-backward mr-2"></i> Orqaga ', ['to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ']) ?>
        <!--        --><? //= Html::a(' <i class="fas fa-trash"></i> Ochirish', ['delete', 'id' => $model->id], ['class' => 'btn btn-outline-danger btn-icon-text ml-2']) ?>
        <!--        --><? // } ?>

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

    <!--    --><? // echo DetailView::widget(['model' => $model,
    //        'attributes' => [
    //            'id',
    //            'name_uz',
    //            //        'name_ru',
    //            [
    //                'attribute' => 'category_id',
    //                'value' => function ($model) {
    //                    return $model->category->name_uz;
    //                }
    //            ],
    //
    //            [
    //                'attribute' => 'group_id',
    //                'value' => function ($model) {
    //                    return $model->subCategory->name_uz;
    //                }
    //            ],
    //
    //            [
    //                'attribute' => 'type_group_id',
    //                'value' => function ($model) {
    //                    return $model->type->name_uz;
    //                }
    //            ],
    //            [
    //                'attribute' => 'status',
    //                'format' => "raw",
    //
    //                'value' => function ($model) {
    //                    return MainDocument::getStatusNameColored($model->status);
    //                }
    //            ],
    //            'created_at:datetime',
    //            'updated_at:datetime',
    //            'created_by',
    ////            'path',
    //            [
    //                'attribute' => 'path',
    //                'format' => "raw",
    //                'label' => 'Asosiy fayl',
    //                'value' => function ($model) {
    //                    $icon = Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
    //                        ['/documents/doc-template', 'id' => $model->id], ['target' => '_blank']);
    //                    $url = Html::a('Faylni ko\'rish',
    //                        ['/frontend/web' . $model->path], ['target' => '_blank']);
    //                    return $url;
    //                }
    //            ],
    //            [
    //                'attribute' => 'files',
    //                'format' => "raw",
    //                'label' => 'Qoshimcha',
    //                'value' => function ($model) use ($initialPreviewConfigDocs) {
    //                    $url = '';
    //                    foreach ($initialPreviewConfigDocs as $item) {
    //                        $url .= Html::a('<img style="width: 120px; height: 100px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
    //                            ['/frontend' . $item['caption']], ['target' => '_blank']);
    //                    }
    //
    //                    return $url;
    //                }
    //            ],
    //            [
    //                'attribute' => 'conclusion_uz',
    //                'value' => function ($model) {
    ////                    if ($model->status == MainDocument::SIGNED) {
    //                        return $model->conclusion_uz;
    //
    ////                    }
    //                }
    //            ]
    //
    //        ],
    //    ]);


    ?>

    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Xujjat kodi:
                <span class="text-danger"> <?= $model->code_document ?></span>
            </h4>
            <h4 class="card-title">Xujjat nomi: <span class="lead text-primary font-weight-bolder">
                    <?= $model->name_uz ?>
                </span></h4>

            <hr>
            <div class="row">

                <div class="col-md-6">
                    <span class="font-weight-bold">Xujjat turi</span>
                    <p class="text-primary font-weight-bold">
                        <?= $model->category->name_uz ?>
                    </p>
                    <span class="font-weight-bold">Yo'nalish</span>
                    <p class="text-primary font-weight-bold">
                        <?= $model->subCategory->name_uz; ?>
                    </p>
                    <span class="font-weight-bold">Turkumi</span>
                    <p class="text-primary font-weight-bold">
                        <?= $model->type->name_uz; ?>
                    </p>
                </div>
                <div class="col-md-6">
                    <span class="font-weight-bold">Xujjat Yaratilgan sana</span>
                    <p class="text-primary font-weight-bold">
                        <?= date('d-m-Y  h:i:s', $model->created_at) ?>
                    </p>
                    <span class="font-weight-bold">Xujjat yaratgan  shaxs</span>
                    <p class="text-primary font-weight-bold">
                        <?= $model->employ->first_name . ' ' . $model->employ->last_name ?>
                    </p>
                    <span class="font-weight-bold">Status</span>
                    <p class="text-primary font-weight-bold">
                        <?= MainDocument::getStatusNameColored($model->status); ?>
                    </p>


                </div>
                <div class="col-md-12">
                    <span class="font-weight-bold">Qisqa mazmuni</span>
                    <h3 class="text-primary font-weight-bold">
                        <?= $model->doc_about ?>
                    </h3>
                    <hr>
                    <span class="font-weight-bold">Yurist xulosa</span>
                    <h5 class="text-primary font-weight-bold">
                        <?= $model->conclusion_uz ?>
                    </h5>
                </div>


                <div class="col-md-12 mt-4">
                    <h5 class="font-weight-bold">Asosiy fayl fayllar</h5>
                    <div class="card">
                        <div class="card-body ">
                            <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                <? if (true) { ?>
                                    <?= Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                                        ['/documents/doc-template', 'id' => $model->id], ['target' => '_blank']);
                                }


                                ?>


                                <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                    <a target="_blank" href="/frontend/web<?= $model->path ?>"
                                       class="mb-0">Ko'chirib olish</a>
                                    <p class="text-muted mb-1">0.5 mb</p>
                                    <span><?= $model->path ?></span>
                                    <a href="" class="btn btn-outline-danger btn-fw mt-2">Delete</a>
                                </div>
                                <?
                                if ($model->lawyer_conclusion_path) {
                                    echo Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                                        ['/frontend/web' . $model->lawyer_conclusion_path], ['target' => '_blank']);
                                }
                                ?>
                            </div>

                        </div
                    </div>
                </div>


                <hr>


            </div> <!--end row-->
        </div> <!--end card body-->
        <?
        $form = ActiveForm::begin();
        if ($model->status == MainDocument::SIGNING) {

            echo $form->field($model, 'conclusion_uz')->textarea(['row' => 6]);
            ?>
            <div class="form-group">
                <?= Html::submitButton('Xulosa saqlash', ['class' => 'btn btn-success']) ?>
            </div>
        <? }

        ?>

        <?php ActiveForm::end(); ?>
    </div>


</div>