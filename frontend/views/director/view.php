<?php

use common\models\documents\MainDocument;

use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
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
$initialPreviewDocs = [];

if (!empty($model->court_doc)) {
    array_push($initialPreviewDocs, 'https://cdn-icons-png.flaticon.com/512/5968/5968517.png');
    array_push($initialPreviewConfigDocs, [
        'caption' => $model->court_doc,
        'key' => $model->id,
        'icon' => '<i class="fa fa-arrow-circle-right"></i>',
    ]);
}


?>
    <div class="container-fluid p-3">

        <div class="buttons_wrap mb-3">
            <!--            --><? // if (!$model->signed_lawyer && $model->status != MainDocument::NEW) { ?>
            <!--                --><? //= Html::a(' <i class="fas fa-pencil"></i> Imzolash ', ['/director/to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>
            <!--                --><? //= Html::a(' <i class="fas fa-backward mr-2"></i> Orqaga ', ['/director/to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ']) ?>
            <!--            --><? // } ?>
            <? if ($model->status == MainDocument::TOBOSS) { ?>

                <?= Html::a(' <i class="fas fa-backward mr-2"></i> Orqaga ', ['/director/to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ']) ?>

                <?= Html::a(' <i class="fas fa-pencil mr-2"></i>Imzolash ', ['/director/to-finish', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>
            <? } ?>

        </div>

        <? if ($model->status == MainDocument::SIGNING) { ?>
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Yuborildi !
            </div>
        <? } ?>

        <? if ($model->status == MainDocument::REJECTED) { ?>
            <div class="alert alert-fill-danger" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Rad etilgan
            </div>
        <? } ?>

        <? if ($model->status == MainDocument::BOSS_SIGNED) { ?>
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Imzolandi
            </div>
        <? } ?>


        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Xujjat kodi:
                    <span class="text-danger"> <?= $model->code_document ?></span>
                </h4>
                <h4 class="card-title">Xujjat nomi: <span class="lead text-primary font-weight-bolder">
                    <?= $model->name_uz ?>
                </span></h4>

                <hr>
                <div class="row mb-3">

                    <div class="col-md-6">
                        <span class="font-weight-bold card-title">Xujjat bo'limi</span>
                        <p class="text-success font-weight-bold card-title">
                            <?= $model->group->name_uz ?>
                        </p>
                    </div>

                    <? if ($model->category) { ?>
                        <div class="col-md-6">
                            <span class="font-weight-bold   card-title">Xujjat turi</span>
                            <p class="text-success font-weight-bold card-title">
                                <?= $model->category->name_uz ?>
                            </p>
                        </div>

                    <? } ?>

                    <? if ($model->category) { ?>
                        <div class="col-md-6">
                            <span class="font-weight-bold card-title">Yo'nalish</span>
                            <p class="text-success font-weight-bold card-title">
                                <?= $model->subCategory->name_uz; ?>
                            </p>
                        </div>
                    <? } ?>

                    <? if ($model->category) { ?>
                        <div class="col-md-6">

                            <span class="font-weight-bold card-title ">Turkumi</span>
                            <p class="text-success font-weight-bold card-title">
                                <?= $model->type->name_uz; ?>
                            </p>
                        </div>

                    <? } ?>

                    <div class="col-md-6">
                        <span class="font-weight-bold card-title">Xujjat Yaratilgan sana</span>
                        <p class="text-success font-weight-bold card-title">
                            <?= date('d-m-Y  h:i:s', $model->created_at) ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <span class="font-weight-bold card-title">Xujjat yaratgan  shaxs</span>
                        <p class="text-warning font-weight-bold card-title">

                            <?= $model->employ->first_name . ' ' . $model->employ->last_name ?>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <span class="font-weight-bold card-title">Status</span>
                        <p class="text-primary font-weight-bold card-title">
                            <?= MainDocument::getStatusNameColored($model->status); ?>
                        </p>
                        <? if ($model->step == MainDocument::STEP_BOSS_FINISH) { ?>
                            <span class="text-danger font-weight-bold">Jarayon yakunlangan !</span>
                        <? } ?>
                    </div>


                    <div class="col-md-12 mt-4">
                        <span class="font-weight-bold card-title">Qisqa mazmuni</span>
                        <h3 class="text-primary font-weight-bold">
                            <?= $model->doc_about ?>
                        </h3>
                        <hr>
                        <? if ($model->conclusion_uz) { ?>
                            <span class="font-weight-bold card-title">Yurist xulosa</span>
                            <h5 class="text-primary font-weight-bold">
                                <?= $model->conclusion_uz ?>
                            </h5>
                        <? } ?>
                    </div>

                    <hr>

                    <div class="col-md-6 mt-4">
                        <h5 class="font-weight-bold card-title">Asosiy fayl</h5>
                        <div class="card">
                            <div class="card-body ">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <? if ($model->path) { ?>
                                        <?= Html::a('<img style="width: 90px" src="/images/main-file.png" alt="">',
                                            ['/documents/doc-template', 'id' => $model->id], ['target' => '_blank']);
                                    } ?>
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
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-7">
                        <? if ($model->step == MainDocument::STEP_BOSS_FINISH && $model->group_id == 4) { ?>
                            <div class="">
                                <h4 class=" mt-3 card-title">Sud xulosa yuklash</h4>
                                <?
                                echo FileInput::widget(['name' => 'attached',
                                    'id' => 'file_input',
                                    'options' => ['multiple' => true],
//                                    'disabled' => $flag,
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
                                        'maxFileCount' => 1,
                                        'browseIcon' => '<i class="fas fa-upload mr-2"></i> ',
                                        'browseLabel' => 'Fayl yuklash',
                                        'mainClass' => 'input-group-ms',
                                        'overwriteInitial' => true,
                                        'initialPreview' => $initialPreviewDocs,
                                        'initialPreviewAsData' => true,
                                        'initialPreviewDownloadUrl' => Url::base('http') . '/frontend' . $model->court_doc,
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
                        <? } ?>
                    </div>


                    <? if ($files) {
                        foreach ($files as $file) {
                            ?>
                            <div class="col-md-6 mt-4">
                                <h5 class="font-weight-bold card-title">Ilova faylar</h5>
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                            <? if ($model->path) { ?>
                                                <?= Html::a('<img style="width: 90px" src="/images/add.png" alt="">',
                                                    ['/frontend' . $file->path], ['target' => '_blank']);
                                            } ?>
                                            <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                                <a target="_blank" href="/frontend<?= $file->path ?>"
                                                   class="mb-0 text-warning font-weight-bold"> <i
                                                            class="fa fa-cloud-download mr-1"></i>
                                                    Ko'chirib olish</a>

                                                <p class="text-muted mb-1">
                                                    <?
                                                    if (file_exists(Yii::getAlias('@frontend') . $file->path)) {
                                                        $size = filesize(Yii::getAlias('@frontend') . $file->path);
                                                        echo human_filesize($size, 3);
                                                    } ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?
                        }
                    } ?>

                </div> <!--end row-->
            </div> <!--end row-->
        </div> <!--end card body-->
        <? if ($model->lawyer_conclusion_path) { ?>

            <div class="card mt-4">
                <div class="card-body">
                    <h5 class="font-weight-bold card-title">Yurist biriktirtan xujjat</h5>
                    <hr>

                    <div class="row">

                        <div class="col-md-6 mt-3">
                            <div class="card">
                                <div class="card-body ">
                                    <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                        <?
                                        echo Html::a('<img style="width: 90px" src="/images/add.png" alt="">',
                                            ['/frontend/web' . $model->lawyer_conclusion_path], ['target' => '_blank']);
                                        ?>
                                        <div class="ml-sm-3">

                                            <a target="_blank"
                                               href="/frontend/web<?= $model->lawyer_conclusion_path ?>"
                                               class="mb-0 text-warning font-weight-bold ">
                                                <i class="fa fa-cloud-download mr-1"></i>
                                                Ko'chirib olish</a>
                                            <p class="text-muted mb-1">
                                                <?
                                                if (file_exists(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path)) {
                                                    $size = filesize(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path);
                                                    echo human_filesize($size, 3);
                                                }

                                                ?>

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
<?php Modal::begin([
    'title' => '<span class="modal-header-main">Xujjatni ko\'rish </span>',
    'id' => 'modalInstallment',
    'size' => 'modal-dialog modal-lg',
    'headerOptions' => [
        'id' => 'modalInstallmentHeader'
    ],
    'titleOptions' => [
        'class' => 'title-orange-border text-bold text-uppercase',
    ],
    'options' => [
        'class' => 'modalInstallment',
    ],
    'closeButton' => [
        'id' => 'close-button',
        'class' => 'close',
        'data-dismiss' => 'modal',
    ],
    'clientOptions' => [
        //            'backdrop' => 'static',
        'keyboard' => true,
    ],
]); ?>
    <div id='modalInstallmentContent' class="modalContent">
        <div class="loading">
            <div style="text-align:center">
                <?php echo Html::img('@web/public/images/loading.gif'); ?>
            </div>
        </div>
    </div>
<?php Modal::end(); ?>

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