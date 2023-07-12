<?php

use common\models\documents\MainDocument;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Main Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$initialPreviewDocs = [];
$initialPreview = [];
$initialPreviewConfigDocs = [];
$initialPreviewConfig = [];

if (!empty($model->path)) {

    array_push($initialPreview, 'https://cdn-icons-png.flaticon.com/512/5968/5968517.png');
    array_push($initialPreviewConfig, [
        'caption' => $model->path,
        'key' => $model->path,
    ]);

}


if (!empty($model->attach)) {
    foreach ($model->attach as $item) {

        array_push($initialPreviewDocs, 'https://cdn-icons-png.flaticon.com/512/5968/5968517.png');
//        array_push($initialPreviewDownloadUrl, Url::base('http') . '/frontend' . $item->path);
        array_push($initialPreviewConfigDocs, [
            'caption' => $item->path,
            'key' => $item->main_document_id,
//            'type' => "office",
//            'url' => '/frontend' . $item->path,
//            'description' => ' This is a representative description number four for this file.',
        ]);
    }
}
//dd(Url::base('http');
?>

<div class="main-document-view">


    <? $form = ActiveForm::begin(); ?>
    <?php echo $form->field($model, 'files')->hiddenInput(['id' => 'images'])->label(false) ?>
    <?php echo $form->field($model, 'deleted_files')->hiddenInput(['id' => 'deleted_images'])->label(false) ?>
    <!--    --><?php //echo $form->field($main, 'sorted_images')->hiddenInput(['id' => 'sorted_images'])->label(false) ?>
    <?php $this->registerJs("
                    var uploadedImages = {}, deletedImages = [],
                    uploaded = document.getElementById('images'),
                    deleted = document.getElementById('deleted_images'),
                    sorted = document.getElementById('sorted_images');")
    ?>
    <div class="container-fluid px-5 py-3">

        <div class="buttons_wrap mb-3">
            <?= Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i> Yuborish', ['to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-icon-text']) ?>
            <?= Html::a(' <i class="fas fa-trash"></i> Ochirish', ['delete', 'id' => $model->id], ['class' => 'btn btn-outline-danger btn-icon-text ml-2']) ?>
        </div>
        <? if ($model->status == MainDocument::NEW) { ?>
            <div class="alert alert-fill-info" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Xujjar yuborilmagan
            </div>
        <? } ?>
        <? if ($model->status == MainDocument::SIGNING) { ?>
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Xujjar yuborilgan
            </div>
        <? } ?>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Xujjat kodi:
                    <span class="text-danger"> <?= $model->id ?></span>
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
                            <?= $model->created_by ? $model->created_by : 'Admin' ?>
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
                    </div>


                    <!---->
                    <!--                <div class="col-md-12 mt-4">-->
                    <!--                    <h5 class="font-weight-bold">Biriktirilgan fayllar</h5>-->
                    <!--                    <div class="card">-->
                    <!--                        <div class="card-body ">-->
                    <!--                            <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">-->
                    <!--                                <img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png"-->
                    <!--                                     alt="">-->
                    <!--                                <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">-->
                    <!--                                    <a href="/frontend/web-->
                    <? //= $model->path ?><!--" class="mb-0">--><? //= $model->path ?><!--</a>-->
                    <!--                                    <p class="text-muted mb-1">0.5 mb</p>-->
                    <!--                                    <a href="" class="btn btn-outline-danger btn-fw mt-2">Delete</a>-->
                    <!---->
                    <!--                                </div>-->
                    <!--                            </div>-->
                    <!---->
                    <!--                        </div-->
                    <!--                    </div>-->
                    <!--                </div>-->


                    <div class="col-md-12">
                        <? //
                        echo FileInput::widget(['name' => 'path',
                            'options' => ['multiple' => true],
                            'pluginOptions' => ['previewFileType' => 'any',
                                'showPreview' => true,
                                'showCaption' => false,
                                'showUpload' => true,
                                'maxFileSize' => 2000,
                                'maxFileCount' => 20,
                                'overwriteInitial' => false,
                                'initialPreview' => $initialPreview,
                                'initialPreviewAsData' => true,
                                'initialPreviewConfig' => $initialPreviewConfig,
                                'browseClass' => 'btn btn-success',
                                'uploadClass' => 'btn btn-info',
                                'removeClass' => 'btn btn-danger',
                                'removeIcon' => '<i class="fas fa-trash"></i> ',
                                'fileActionSettings' => ['removeIcon' => '<i class="fa fa-trash"></i>',
                                    'uploadIcon' => '<i class="fa fa-upload" aria-hidden="true"></i>',
                                    'zoomIcon' => '<i class="fa fa-search-plus"></i>',
                                    'rotateIcon' => '<i class="fa fa-arrow-circle-right"></i>',],]]);
                        //                        ?>
                    </div>


                    <hr>
                    <div class="col-md-12 mt-4">
                        <?
                        echo FileInput::widget(['name' => 'attached',
                            'id' => 'file_input',
                            'options' => ['multiple' => true],
                            'pluginOptions' => ['uploadUrl' => Url::to(['upload-docs', 'id' => $model->id]),
                                'deleteUrl' => Url::to(['delete-docs', 'id' => $model->id]),
                                'showCancel' => false,
                                'showCaption' => false,
                                'showUpload' => true,
                                'maxFileSize' => 2000,
                                'maxFileCount' => 20,

                                'overwriteInitial' => true,
                                'initialPreview' => $initialPreviewDocs,
                                'initialPreviewAsData' => true,
                                //                            'initialPreviewDownloadUrl' => Url::base('http') . '/frontend' . $model->path,
                                //                                'previewFileIcon' => '<i class="fas fa-file"></i>',
                                'allowedPreviewTypes' => null, // set to empty, null or false to disable preview for all types
                                'initialPreviewConfig' => $initialPreviewConfigDocs,
                                'browseClass' => 'btn btn-success',
                                'uploadClass' => 'btn btn-info',
                                'removeClass' => 'btn btn-danger',
                                'removeIcon' => '<i class="fas fa-trash"></i> ',
                                'fileActionSettings' => ['removeIcon' => '<i class="fa fa-trash"></i>',
                                    'uploadIcon' => '<i class="fa fa-upload" aria-hidden="true"></i>',
                                    'zoomIcon' => '<i class="fa fa-search-plus"></i>',
                                    'rotateIcon' => '<i class="fa fa-arrow-circle-right"></i>',],
                                'previewFileIconSettings' => ['docx' => '<i class="fas fa-file-word"></i>',],
                                //                                'previewFileExtSettings' => [
                                //                                    'doc' => function ($model) {
                                //                                        return $model.match(/(doc | docx)$/i);
                                //    },

                                //                                ]


                            ]]);
                        ?>
                    </div>


                </div> <!--end row-->
            </div> <!--end card body-->

        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <!--    --><? //= DetailView::widget([
    //        'model' => $model,
    //        'attributes' => [
    //
    //            'name_uz',
    //            'name_ru',
    //            'category_id',
    //            'group_id',
    //            'status',
    //            'created_at',
    //            'updated_at',
    //            'created_by',
    //            'path',
    //            'time_begin:datetime',
    //            'time_end:datetime',
    //        ],
    //    ]) ?>

</div>
