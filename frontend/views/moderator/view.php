<?php

use common\models\documents\MainDocument;
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
                            <span class="font-weight-bold card-title">Xujjat bo'limi</span>
                            <p class="text-primary font-weight-bold card-title">
                                <?= $model->group->name_uz ?>
                            </p>
                            <? if ($model->category) { ?>
                                <span class="font-weight-bold   card-title">Xujjat turi</span>
                                <p class="text-primary font-weight-bold card-title">
                                    <?= $model->category->name_uz ?>
                                </p>
                                <span class="font-weight-bold card-title">Yo'nalish</span>
                                <p class="text-primary font-weight-bold card-title">
                                    <?= $model->subCategory->name_uz; ?>
                                </p>
                                <span class="font-weight-bold card-title ">Turkumi</span>
                                <p class="text-primary font-weight-bold card-title">
                                    <?= $model->type->name_uz; ?>
                                </p>
                            <? } ?>

                        </div>
                        <div class="col-md-6">
                            <span class="font-weight-bold card-title">Xujjat Yaratilgan sana</span>
                            <p class="text-success font-weight-bold card-title">
                                <?= date('d-m-Y  h:i:s', $model->created_at) ?>
                            </p>
                            <span class="font-weight-bold card-title">Xujjat yaratgan  shaxs</span>
                            <p class="text-warning font-weight-bold card-title">

                                <?= $model->employ->first_name . ' ' . $model->employ->last_name ?>
                            </p>
                            <span class="font-weight-bold card-title">Status</span>
                            <p class="text-primary font-weight-bold card-title">
                                <?= MainDocument::getStatusNameColored($model->status); ?>
                            </p>

                        </div>

                        <div class="col-md-12">
                            <span class="font-weight-bold card-title">Qisqa mazmuni</span>
                            <h4 class="text-primary font-weight-bold">
                                <?= $model->doc_about ?>
                            </h4>
                            <hr>
                        </div>

                        <div class="col-md-6 mt-4">
                            <h5 class="font-weight-bold">Asosiy xujjat</h5>
                            <div class="card">
                                <div class="card-body ">
                                    <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">

                                        <?= Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                                            ['doc-template', 'id' => $model->id], ['target' => '_blank']);

                                        ?>
                                        <!--                                        <img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">-->
                                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <a target="_blank" href="/frontend/web<?= $model->path ?>"
                                               class="mb-0 text-warning font-weight-bold ">
                                                <i class="fa fa-cloud-download mr-1"></i>
                                                Ko'chirib olish</a>
                                            <p class="text-muted mb-1">
                                                <?
                                                if (file_exists(Yii::getAlias('@frontend') . '/web' . $model->path)) {
                                                    $size = filesize(Yii::getAlias('@frontend') . '/web' . $model->path);
                                                    echo human_filesize($size, 3);
                                                }

                                                ?>
                                            </p>
                                            <!--                                            <a href="" class="btn btn-outline-danger btn-fw mt-2">Delete</a>-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 mt-4">
                            <? if ($model->lawyer_conclusion_path) { ?>
                                <h5 class="font-weight-bold">Yurist biriktirtan xujjat</h5>
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                            <?
                                            echo Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                                                ['/frontend/web' . $model->lawyer_conclusion_path], ['target' => '_blank']);
                                            ?>
                                            <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                                <a target="_blank"
                                                   href="/frontend/web<?= $model->lawyer_conclusion_path ?>"
                                                   class="mb-0 text-warning font-weight-bold">
                                                    <i class="fa fa-cloud-download mr-1"></i>
                                                    Ko'chirib olish</a>
                                                <p class="text-muted mb-1">
                                                    <?
                                                    $size = filesize(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path);
                                                    echo human_filesize($size, 3)
                                                    ?>

                                                </p>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            <? } ?>
                        </div>


                        <!--                    --><? // if ($model->status != MainDocument::NEW) {
                        //
                        //                        if ($model->attach) { ?>
                        <!--                            <h5 class="font-weight-bold ">Qoshimcha faylar</h5>-->
                        <!--                            --><? // foreach ($model->attach as $item) { ?>
                        <!--                                <div class="col-md-6 mt-4">-->
                        <!--                                    <div class="card">-->
                        <!--                                        <div class="card-body ">-->
                        <!--                                            <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">-->
                        <!--                                                --><? // if ($model->path) { ?>
                        <!--                                                    --><? //= Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                        //                                                        ['/frontend' . $item->path], ['target' => '_blank']);
                        //                                                } ?>
                        <!--                                                <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">-->
                        <!--                                                    <a target="_blank" href="/frontend-->
                        <? //= $item->path ?><!--"-->
                        <!--                                                       class="mb-0">Ko'chirib olish</a>-->
                        <!--                                                    <p class="text-muted mb-1">-->
                        <!--                                                        --><? //
                        //
                        //                                                        if (file_exists(Yii::getAlias('@frontend') . $item->path)) {
                        //                                                            $size = filesize(Yii::getAlias('@frontend') . $item->path);
                        //                                                            echo human_filesize($size, 3);
                        //
                        //                                                        }
                        //
                        //                                                        ?>
                        <!---->
                        <!--                                                    </p>-->
                        <!---->
                        <!--                                                </div>-->
                        <!--                                            </div>-->
                        <!--                                        </div>-->
                        <!--                                    </div>-->
                        <!--                                </div>-->
                        <!--                                --><? //
                        //                            }
                        //                        } ?>
                        <!--                    --><? // } else { ?>

                        <div class="col-md-12 mt-4">
                            <h5 class="font-weight-bold">Ilovalar</h5>
                            <?
                            //                        $flag = false;
                            $flag = $model->status != MainDocument::NEW ? true : false;
                            echo FileInput::widget(['name' => 'attached',
                                'id' => 'file_input',
                                'options' => ['multiple' => true],
                                'disabled' => $flag,
                                'messageOptions' => ['class' => 'alert alert-warning'],
                                //                                'readonly' => true,

                                'pluginOptions' => [
                                    'allowedFileExtensions' => ["jpg", "png", "docx", 'doc', 'pdf'],
                                    'uploadUrl' => Url::to(['upload-docs', 'id' => $model->id]),
                                    'deleteUrl' => Url::to(['delete-docs']),
                                    'previewFileType' => 'image',
                                    'elCaptionText' => '#customCaption',
                                    'showCancel' => false,
                                    'showCaption' => false,
                                    'showUpload' => false,
                                    'maxFileSize' => 1000,
                                    'maxFileCount' => 10,
                                    'browseIcon' => '<i class="fas fa-upload mr-2"></i> ',
                                    'browseLabel' => 'Fayl yuklash',
                                    'mainClass' => 'input-group-lg',
//                                'disabled' => $flag,
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
                        <!--                    --><? // } ?>
                    </div>
                </div> <!--end row-->
            </div> <!--end card body-->

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

?>