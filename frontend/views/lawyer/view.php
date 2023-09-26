<?php

use common\models\documents\MainDocument;

use kartik\editable\Editable;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */

$this->title = $model->name_uz;
$this->params['breadcrumbs'][] = ['label' => 'Main Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$initialPreviewConfigDocs = [];
$initialPreviewConfig = [];

$initialPreviewDocs = [];

if (!empty($model->lawyer_conclusion_path)) {

    array_push($initialPreviewDocs, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQTgNAULTPrkVqqr6zl4VnsjkZS7XeAURSqCYfthldXEI6QNHwaxvsqJIAu1Swe4T7bzqE&usqp=CAU');
    array_push($initialPreviewConfig, [
        'caption' => $model->lawyer_conclusion_path,
        'key' => $model->lawyer_conclusion_path,
    ]);
    array_push($initialPreviewConfigDocs, [
        'caption' => "Yurist xujjati",
        'key' => $model->id,

    ]);
}

?>
<div class="container-fluid p-3">
    <div class="buttons_wrap mb-3">
        <? if ($model->status != MainDocument::SUCCESS && $model->status != MainDocument::BOSS_SIGNED) { ?>
            <?= Html::a(' <i class="fas fa-pencil"></i> Imzolash ', ['to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>
            <?= Html::a(' <i class="fas fa-backward mr-2"></i> Rad etish ', ['to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ']) ?>

        <? } ?>
        <? if ($model->status == MainDocument::SUCCESS) { ?>
            <!--        --><? //= Html::button(' <i class="fas fa-pencil mr-2"></i> Imzolash', ['type' => 'submit', 'class' => 'btn btn-outline-success btn-icon-text']) ?>
            <!--        --><? //= Html::a(' <i class="fas fa-trash"></i> Ochirish', ['delete', 'id' => $model->id], ['class' => 'btn btn-outline-danger btn-icon-text ml-2']) ?>
        <? } ?>


    </div>

    <? if ($model->status == MainDocument::REJECTED) { ?>
        <div class="alert alert-fill-danger" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Rad etilgan
        </div>
    <? } ?>

    <? if ($model->status == MainDocument::SUCCESS) { ?>
        <div class="alert alert-fill-success" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Imzolandi !
        </div>
    <? } ?>
    <? if ($model->status == MainDocument::BOSS_SIGNED) { ?>
        <div class="alert alert-fill-success" role="alert">
            <i class="mdi mdi-alert-circle"></i>
            Rahbar tomonidan imzolandi !
        </div>
    <? } ?>


    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Xujjat kodi:
                <span class="lead text-danger font-weight-bolder"> <?= $model->code_document ?></span>
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
                    <? if ($model->category) { ?>
                        <span class="font-weight-bold   card-title">Xujjat turi</span>
                        <p class="text-success font-weight-bold card-title">
                            <?= $model->category->name_uz ?>
                        </p>
                        <span class="font-weight-bold card-title">Yo'nalish</span>
                        <p class="text-success font-weight-bold card-title">
                            <?= $model->subCategory->name_uz; ?>
                        </p>
                        <span class="font-weight-bold card-title ">Turkumi</span>
                        <p class="text-success font-weight-bold card-title">
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
                    <? if ($model->step == MainDocument::STEP_BOSS_FINISH) { ?>
                        <span class="text-danger font-weight-bold">Jarayon yakunlangan !</span>
                    <? } ?>

                </div>
                <div class="col-md-12">
                    <span class="font-weight-bold card-title">Qisqa mazmuni</span>
                    <p class="text-warning font-weight-bold card-title">
                        <?= $model->doc_about ?>
                    </p>
                    <hr>
                    <? if ($model->conclusion_uz) { ?>

                        <span class="font-weight-bold card-title">Yurist xulosasi</span>
                        <h5 class="text-primary font-weight-bold">
                            <?
                            echo Editable::widget([
                                'name' => 'notes',
                                'asPopover' => true,
                                'displayValue' => $model->conclusion_uz,
                                'format' => Editable::FORMAT_BUTTON,
                                'editableValueOptions' => ['class' => 'text-danger'],
                                'inputType' => Editable::INPUT_TEXTAREA,
                                'value' => $model->conclusion_uz,
                                'header' => 'Yurist xulosa',
                                'size' => 'lg',
                                'submitOnEnter' => true,
                                'editableButtonOptions' => [
                                    'label' => '<i class="fas fa-edit"></i>',
                                ],
                                'submitButton' => [
                                    'icon' => '<i class="fas fa-check"></i>',
                                    'class' => 'btn btn-success',
                                    'label' => 'btn btn-success',
                                ],
                                'options' => [
                                    'class' => 'form-control',
                                    'rows' => 5,
                                    'placeholder' => 'Yurist xulosasi...',
                                ],
                            ]);
                            ?>
                            <!--                            --><? //= $model->conclusion_uz ?>
                        </h5>
                    <? } ?>
                </div>

                <hr>

                <div class="col-md-4 mt-4">
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
                                       class="mb-0 text-warning font-weight-bold"> <i
                                                class="fa fa-cloud-download mr-1"></i>Ko'chirib olish</a>
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
                    <input type="">
                </div>

                <? if ($files) {
                    foreach ($files as $file) {
                        ?>
                        <div class="col-md-4 mt-4">
                            <h5 class="font-weight-bold card-title ">Ilova faylar</h5>
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
                                                        class="fa fa-cloud-download mr-1"></i>Ko'chirib olish</a>
                                            <p class="text-muted mb-1">
                                                <?

                                                if (file_exists(Yii::getAlias('@frontend') . '/web' . $file->path)) {
                                                    $size = filesize(Yii::getAlias('@frontend') . '/web' . $file->path);
                                                    echo human_filesize($size, 3);
                                                }
                                                ?>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?
                    }
                } ?>

            </div>
            <!--end row-->


            <?
            if ($model->category && !$model->conclusion_uz) {
                $form = ActiveForm::begin();
                if ($model->status == MainDocument::EDITED || $model->status == MainDocument::SIGNING) {
                    echo $form->field($model, 'conclusion_uz')->textarea(['rows' => 6])->label('Xulosa') ?>
                    <div class="form-group">
                        <?= Html::submitButton('Xulosa saqlash', ['class' => 'btn btn-success']) ?>
                    </div>
                <? } ?>

                <?php ActiveForm::end();
            } ?>
        </div> <!--end row-->
    </div> <!--end card body-->
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="font-weight-bold card-title">Yurist biriktirtan xujjat (Xulosa)</h5>
            <hr>
            <div class="row">
                <div class="col-md-4 mt-3">
                    <? if ($model->lawyer_conclusion_path) { ?>
                        <div class="card">
                            <div class="card-body ">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <?
                                    echo Html::a('<img style="width: 90px" src="/images/main-file.png" alt="">',
                                        ['/frontend/web' . $model->lawyer_conclusion_path], ['target' => '_blank']);
                                    ?>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <a target="_blank"
                                           href="/frontend/web<?= $model->lawyer_conclusion_path ?>"
                                           class="mb-0 text-warning font-weight-bold">
                                            <i class="fa fa-cloud-download mr-1"></i>
                                            Ko'chirib olish</a>
                                        <p class="text-muted mb-1">
                                            <? if (file_exists(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path)) {
                                                $size = filesize(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path);
                                                echo human_filesize($size, 3);
                                            }
                                            ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <? } ?>
                    <? if ($model->status == MainDocument::SIGNING) {
                        echo Html::a('<i class="mdi mdi-file-document mr-2"></i> Davo ariza biriktirish',
                            ['/lawyer/doc-template', 'id' => $model->id],
                            ['class' => 'btn btn-primary mt-3']) ?>

                        <!--                        --><? // if (!$model->category) {
//                            echo FileInput::widget(['name' => 'lawyer_conclusion_path',
//                                'id' => 'file_input',
//                                'options' => ['multiple' => true],
//                                'pluginOptions' => [
//                                    'allowedFileExtensions' => ["docx"],
//                                    'uploadUrl' => Url::to(['upload-conclusion', 'id' => $model->id]),
//                                    'deleteUrl' => Url::to(['delete-conclusion']),
//                                    'showCancel' => false,
//                                    'showCaption' => false,
//                                    'showUpload' => false,
//                                    'maxFileSize' => 2000,
//                                    'maxFileCount' => 1,
//                                    'overwriteInitial' => false,
//                                    'initialPreview' => $initialPreviewDocs,
//                                    'initialPreviewAsData' => true,
//                                    'initialPreviewDownloadUrl' => Url::base('http') . '/frontend/web' . $model->lawyer_conclusion_path,
//                                    'allowedPreviewTypes' => false, // set to empty, null or false to disable preview for all types
//                                    'initialPreviewConfig' => $initialPreviewConfigDocs,
//                                    'browseClass' => 'btn btn-success',
//                                    'uploadClass' => 'btn btn-info',
//                                    'removeClass' => 'btn btn-danger',
//                                    'removeIcon' => '<i class="fas fa-trash"></i> ',
//                                    'fileActionSettings' => ['removeIcon' => '<i class="fa fa-trash"></i>',
//                                        'uploadIcon' => '<i class="fa fa-upload" aria-hidden="true"></i>',
//                                        'downloadIcon' => '<i class="fa fa-download" aria-hidden="true"></i>',
//                                        'zoomIcon' => '<i class="fa fa-search-plus"></i>',
//                                        'rotateIcon' => '<i class="fa fa-arrow-circle-right"></i>',
//                                    ],
//                                    'previewFileIconSettings' => [
//                                        'docx' => '<i class="fas fa-file-word"></i>',
//                                        'pdf' => '<i class="fas fa-file-pdf"></i>',
//                                        'xls' => '<i class="fas fa-file-word"></i>',
//                                        'doc' => '<i class="fas fa-file-word"></i>',
//                                    ],
//                                ]]);
//                        }
//                        ?>

                    <? } ?>


                </div>

            </div>
        </div>
    </div>

</div>

