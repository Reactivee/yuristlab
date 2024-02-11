<?php

use common\models\documents\MainDocument;
use frontend\widgets\AllViewer;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */

$this->title = $model->name_uz;
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
//        'icon' => '<i class="fa fa-arrow-circle-right"></i>',
    ]);

}


if (!empty($model->attach)) {

    foreach ($model->attach as $item) {

//        array_push($initialPreviewDocs, $item->path);
        array_push($initialPreviewDocs, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTgNAULTPrkVqqr6zl4VnsjkZS7XeAURSqCYfthldXEI6QNHwaxvsqJIAu1Swe4T7bzqE&usqp=CAU');
        array_push($initialPreviewConfigDocs, [
            'caption' => 'Xujjatga ilova',
            'key' => $item->id,
            'icon' => '<i class="fa fa-arrow-circle-right"></i>',
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

                <? if (($model->category && $model->status == MainDocument::NEW) || ($model->category && $model->status == MainDocument::REJECTED)) { ?>
                    <?= Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i>Yuristga yuborish', ['to-sign', 'id' => $model->id], ['class' => 'ml-2 btn btn-outline-primary btn-icon-text']); ?>
                <? } ?>
                <?

                if (!$model->category && $model->status == MainDocument::BOSS_SIGNED && $model->step != MainDocument::STEP_BOSS_FINISH) {
                    echo Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i>Yuristga yuborish', ['to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-icon-text']);
                }
                ?>

<!--                --><?//
//                if (!$model->category && $model->status == MainDocument::NEW) {
//                    echo Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i> Rahbarga yuborish', ['to-presign', 'id' => $model->id], ['class' => 'btn btn-outline-warning btn-icon-text']);
//                }
//                ?>
                <? if ($model->status == MainDocument::SUCCESS) { ?>
                    <?= Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i> Rahbarga yuborish', ['to-presign', 'id' => $model->id], ['class' => 'btn btn-outline-warning btn-icon-text']) ?>
                <? } ?>

                <?
                //
                //                if (!$model->signed_lawyer && $model->status == MainDocument::BOSS_SIGNED) { ?>
                <!--                    --><?//= Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i>Yuristga yuborish', ['to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-icon-text']) ?>
                <!--                --><?// } ?>
                <? if ((!$model->category &&$model->status == MainDocument::NEW) || $model->status == MainDocument::REJECTED) { ?>
                    <?= Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i> Rahbarga yuborish', ['to-presign', 'id' => $model->id], ['class' => 'btn btn-outline-warning btn-icon-text']) ?>
                    <!--                    --><? //= Html::a(' <i class="mdi mdi-send btn-icon-prepend"></i>Yuristga yuborish', ['to-sign', 'id' => $model->id], ['class' => 'ml-2 btn btn-outline-primary btn-icon-text']); ?>
                    <?= Html::a(' <i class="fas fa-trash"></i> O\'chirish', ['delete', 'id' => $model->id], ['class' => 'btn btn-outline-danger btn-icon-text ml-2 ']) ?>
                <? } ?>
            </div>
            <? if ($model->status == MainDocument::NEW) { ?>
                <div class="alert alert-fill-info" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    Xujjat yuborilmagan
                </div>
            <? } ?>
            <? if ($model->status == MainDocument::SIGNING) { ?>
                <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    Xujjat yuborilgan
                </div>
            <? } ?>
            <? if ($model->status == MainDocument::EDITED) { ?>
                <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    Xujjat yuborilgan
                </div>
            <? } ?>
            <? if ($model->status == MainDocument::TOBOSS) { ?>
                <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    Xujjat yuborilgan !
                </div>
            <? } ?>

            <? if ($model->step == MainDocument::STEP_BOSS_FINISH) { ?>
                <div class="alert alert-fill-success" role="alert">
                    <i class="mdi mdi-alert-circle"></i>
                    Xujjat imzolandi !
                </div>
            <? } ?>

            <div class="card">
                <?= AllViewer::widget([
                    'model' => $model
                ]) ?>

                <div class="">
                    <? if ($model->status == MainDocument::NEW || $model->status == MainDocument::REJECTED) { ?>
                        <div class="col-md-12 mt-4">
                            <h5 class="font-weight-bold card-title">Ilovalar</h5>
                            <? $flag = ($model->status == MainDocument::NEW || $model->status == MainDocument::REJECTED) ? false : true;
                            echo FileInput::widget(['name' => 'attached',
                                'id' => 'file_input',
                                'options' => ['multiple' => true],
                                'disabled' => $flag,
                                'messageOptions' => ['class' => 'alert alert-warning'],
                                'pluginOptions' => [
                                    'allowedFileExtensions' => ["jpg", "png", "docx", 'doc', 'pdf'],
                                    'uploadUrl' => Url::to(['upload-docs', 'id' => $model->id]),
                                    'deleteUrl' => Url::to(['delete-docs']),
                                    'previewFileType' => 'image',
                                    'elCaptionText' => '#customCaption',
                                    'showCancel' => false,
                                    'showCaption' => false,
                                    'showRemove' => false,
                                    'showUpload' => false,
                                    'maxFileSize' => 1000,
                                    'maxFileCount' => 10,
                                    'browseIcon' => '<i class="fas fa-upload mr-2"></i> ',
                                    'browseLabel' => 'Fayl yuklash',
                                    'mainClass' => 'input-group-ms',
                                    'overwriteInitial' => true,
                                    'initialPreview' => $initialPreviewDocs,
                                    'initialPreviewAsData' => true,
                                    'initialPreviewDownloadUrl' => Url::base('http') . '/frontend' . $item->path,
                                    'previewFileIcon' => '<i class="fa fa-file"></i>',
                                    'allowedPreviewTypes' => null, // set to empty, null or false to disable preview for all types
                                    'initialPreviewConfig' => $initialPreviewConfigDocs,
                                    'browseClass' => 'btn btn-success',
                                    'uploadClass' => 'btn btn-info',
                                    'removeClass' => 'btn btn-danger',
                                    'removeIcon' => '<i class="fas fa-trash"></i> ',
                                    'fileActionSettings' => [
                                        'downloadIcon' => '<i class="fa fa-download" aria-hidden="true"></i>',
                                        'removeIcon' => '<i class="fa fa-trash"></i>',
                                        'uploadIcon' => '<i class="fa fa-upload" aria-hidden="true"></i>',
                                        'zoomIcon' => '<i class="fa fa-search-plus"></i>',
                                        'rotateIcon' => '<i class="fa fa-arrow-circle-right"></i>',],
                                    'previewFileIconSettings' => [
                                        'docx' => '<i class="fas fa-file-word"></i>',
                                        'pdf' => '<i class="fas fa-file-word"></i>',
                                        'xls' => '<i class="fas fa-file-word"></i>',
                                        'doc' => '<i class="fas fa-file-word"></i>',
                                    ],
                                ]]);
                            ?>
                        </div>
                    <? } else { ?>
                        <? if ($model->attach) { ?>

                            <div class="card-body">
                                <h5 class="pl-2 font-weight-bold  card-title">Ilova faylar</h5>
                                <div class="row">
                                    <? foreach ($model->attach as $file) { ?>
                                        <div class="col-md-4 mt-2">
                                            <div class="card">
                                                <div class="card-body ">
                                                    <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                                        <? if ($model->path) { ?>
                                                            <?= Html::a('<img style="width: 90px" src="/images/add.png" alt="">',
                                                                ['/frontend' . $file->path], ['target' => '_blank']);
                                                        } ?>
                                                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                                            <a target="_blank" href="/frontend<?= $file->path ?>"
                                                               class="mb-0 text-warning font-weight-bold">
                                                                <i class="fa fa-cloud-download mr-1"></i>Ko'chirib olish</a>
                                                            <p class="text-muted mb-1">
                                                                <?

                                                                if (file_exists(Yii::getAlias('@frontend') . '/web' . $file->path)) {
                                                                    $size = filesize(Yii::getAlias('@frontend') . $file->path);
                                                                    echo human_filesize($size, 3);
                                                                }
                                                                ?>
                                                            </p>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <? } ?>
                                </div>
                            </div>
                        <? } ?>
                        <?
                    } ?>
                </div>


            </div> <!--end card body-->
            <? if ($model->lawyer_conclusion_path) { ?>
                <div class="card mt-4">
                    <div class="card-body">
                        <h5 class="font-weight-bold card-title">Yurist biriktirtan xujjat (Xulosa)</h5>
                        <hr>
                        <div class="row p-0 m-0">
                            <div class="col-md-4 mt-4">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                            <? echo Html::a('<img style="width: 90px" src="/images/main-file.png" alt="">',
                                                ['/frontend/web' . $model->lawyer_conclusion_path], ['target' => '_blank']); ?>
                                            <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                                <a target="_blank"
                                                   href="/frontend/web<?= $model->lawyer_conclusion_path ?>"
                                                   class="mb-0 text-warning font-weight-bold">
                                                    <i class="fa fa-cloud-download mr-1"></i>
                                                    Ko'chirib olish</a>
                                                <p class="text-muted mb-1">
                                                    <?
                                                    if (file_exists(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path)) {
                                                        $size = filesize(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path);
                                                        echo human_filesize($size, 3);
                                                    } ?>
                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            <? } ?>
        </div>


    </div>

<?php

$script = <<<JS


$(function(){
    var loading = $('#modalInstallment .loading').html();
    $(document).on('click', '.showInstallmentModal', function(e){
        e.preventDefault();
        $('#modalInstallment').find('#modalInstallmentContent').html(loading);
        console.log($('#modalInstallment').data('amount'));
        console.log($('#modalInstallment').data('bs.modal'));
        if ($('#modalInstallment').data('bs.modal').isShown) {
            $('#modalInstallment').find('#modalInstallmentContent')
                .load($(this).attr('data-href')); 
            $('#installmentTab a').on('click', function (e) {
              e.preventDefault();
              $(this).tab('show');
            })
        } else {
            $('#modalInstallment').modal('show')
                .find('#modalInstallmentContent')
                .load($(this).attr('data-href'));
            $('#installmentTab a').on('click', function (e) {
              e.preventDefault()
              $(this).tab('show')
            })
        }
        return false;
    });

})

JS;
$this->registerJs($script);
