<?php

use common\models\documents\CategoryDocuments;
use common\models\documents\TypeDocuments;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Url;
use yii\web\JsExpression;

//use yii\widgets\ActiveForm;
/** @var \common\models\documents\MainDocument $main */

/** @var \common\models\forms\CreateDocForm $model */

$this->title = 'Create new';

$initialPreview = [];
$initialPreviewConfig = [];
//if (!empty($images = $model->complexImages)) {
//    foreach ($images as $image) {
//        array_push($initialPreview, $image->path);
//        array_push($initialPreviewConfig, [
//            'caption' => $image->name,
//            'key' => $image->generate_name,
//        ]);
//    }
//}
?>
<div class="container-fluid m-4 pr-5">
    <? $form = ActiveForm::begin();

    ?>
    <?php echo $form->field($main, 'files')->hiddenInput(['id' => 'images'])->label(false) ?>
    <?php echo $form->field($main, 'deleted_files')->hiddenInput(['id' => 'deleted_images'])->label(false) ?>
    <!--    --><?php //echo $form->field($main, 'sorted_images')->hiddenInput(['id' => 'sorted_images'])->label(false) ?>
    <?php $this->registerJs("
                    var uploadedImages = {}, deletedImages = [],
                    uploaded = document.getElementById('images'),
                    deleted = document.getElementById('deleted_images'),
                    sorted = document.getElementById('sorted_images');")
    ?>
    <div class="row">

        <div class="col-md-4">
            <?
            echo $form->field($main, 'category_id')->widget(Select2::className(), [
                'data' => CategoryDocuments::getCategory(),
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Category'],
                'pluginOptions' => ['allowClear' => true],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?
            echo $form->field($main, 'group_id')->widget(Select2::className(), [
                'data' => CategoryDocuments::subGetCategory(),

                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Category'],
                'pluginOptions' => ['allowClear' => true],
            ]);
            ?>
        </div>
        <div class="col-md-4">
            <?
            echo $form->field($main, 'type_group_id')->widget(Select2::className(), [
                'data' => TypeDocuments::getTypeDoc(),
                'theme' => Select2::THEME_BOOTSTRAP,
                'options' => ['placeholder' => 'Category'],
                'pluginOptions' => ['allowClear' => true],
            ]);
            ?>
            <!--            <div class="dropdown ">-->
            <!--                <button class="btn btn-danger btn-sm dropdown-toggle w-100" type="button" id="dropdownMenuSizeButton3"-->
            <!--                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
            <!--                    Dropdown-->
            <!--                </button>-->
            <!--                <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton3">-->
            <!--                    <h6 class="dropdown-header">Settings</h6>-->
            <!--                    <a class="dropdown-item" href="#">Action</a>-->
            <!--                    <a class="dropdown-item" href="#">Another action</a>-->
            <!--                    <a class="dropdown-item" href="#">Something else here</a>-->
            <!--                    <div class="dropdown-divider"></div>-->
            <!--                    <a class="dropdown-item" href="#">Separated link</a>-->
            <!--                </div>-->
            <!--            </div>-->
        </div>

        <div class="col-md-12">
            <?= $form->field($main, 'name_uz')->textInput() ?>
            <?= $form->field($main, 'doc_about')->textarea(['maxlength' => 6]) ?>
<!--            --><?//= $form->field($main, 'status')->dropdownList([]) ?>
        </div>
        <div class="col-md-12 mb-4">
            <?
            echo FileInput::widget([
                'name' => 'attached',
                'options' => [
                    'multiple' => true,
//                    'accept' => 'images/*'
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['upload-docs']),
                    'deleteUrl' => Url::to(['delete-docs']),
                    'allowedFileExtensions' => ['docx', 'doc', 'pdf', 'jpg', 'jpeg'],
                    'browseClass' => 'btn browse-button',
                    'showCancel' => false,
                    'showClose' => false,
                    'showUpload' => true,
                    'maxFileSize' => 2240,
                    'maxFileCount' => 40,
                    'overwriteInitial' => false,
                    'initialPreview' => $initialPreview,
                    'initialPreviewAsData' => true,
                    'initialPreviewConfig' => $initialPreviewConfig,
                    'fileActionSettings' => [
                        'removeIcon' => '<i class="fa fa-trash"></i>',
                        'uploadIcon' => '<i class="fa fa-upload" aria-hidden="true"></i>',
                        'zoomIcon' => '<i class="fa fa-search-plus"></i>'
                    ],
                ],


                'pluginEvents' => [
                    'fileuploaded' => new JsExpression('function(event, data, previewId) {
                            uploadedImages[previewId] = data.response;
                            uploaded.value = JSON.stringify(uploadedImages);
                        }'),
                    'filedeleted' => new JsExpression('function(event, key) {
                            deletedImages.push(key);
                            deleted.value = JSON.stringify(deletedImages);
                        }'),
                    'filesuccessremove' => new JsExpression('function(event, previewId) {
                            delete uploadedImages[previewId];
                            uploaded.value = JSON.stringify(uploadedImages);
                        }'),
                    'filesorted' => new JsExpression('function(event, params) {
                            sorted.value = JSON.stringify(params.stack);
                        }')
                ]
            ]) ?>


        </div>
        <div class="col-md-12">

            <div class="btn p-0 m-0">
<!--                <label for="asd">Xujjat yuborish</label>-->
                <?= $form->field($main, 'path')->fileInput()->label(false) ?>

            </div>

            <!--            <input type="file">-->

            <button ttype="submit" class="btn btn-success btn-rounded btn-fw">Yuborish</button>
        </div>


    </div>
    <?php ActiveForm::end(); ?>

</div>