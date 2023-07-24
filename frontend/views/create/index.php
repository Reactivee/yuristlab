<?php

use common\models\documents\CategoryDocuments;
use common\models\documents\TypeDocuments;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\JsExpression;
use yii\widgets\Pjax;

//use yii\widgets\ActiveForm;
/** @var \common\models\documents\MainDocument $main */

/** @var \common\models\forms\CreateDocForm $model */

$this->title = 'Create new';
$type_id = Yii::$app->request->getQueryParam('id');
$doc_id = Yii::$app->request->getQueryParam('doc');
$gr = \common\models\documents\GroupDocuments::findOne($doc_id);

//dd(Yii::$app->request->getQueryParam('id'));
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
        <? $form = ActiveForm::begin(); ?>
        <?php echo $form->field($main, 'files')->hiddenInput(['id' => 'images'])->label(false) ?>
        <?php echo $form->field($main, 'deleted_files')->hiddenInput(['id' => 'deleted_images'])->label(false) ?>
        <!--    --><?php //echo $form->field($main, 'sorted_images')->hiddenInput(['id' => 'sorted_images'])->label(false) ?>
        <?php $this->registerJs("
                    var uploadedImages = {}, deletedImages = [],
                    uploaded = document.getElementById('images'),
                    deleted = document.getElementById('deleted_images')")
        ?>
        <? if ($gr) { ?>
            <button type="button"  class="btn btn-outline-info btn-fw mb-3"><?= $gr->name_uz?></button>
        <? } ?>
        <div class="row">
            <div class="col-md-4">
                <?
                echo $form->field($main, 'category_id')->widget(Select2::className(), [
                    'data' => CategoryDocuments::getCategory($doc_id),
                    'theme' => Select2::THEME_BOOTSTRAP,
//                    'type' => DepDrop::TYPE_SELECT2,
                    'options' => ['placeholder' => 'Category', 'id' => 'category_id'],
                    'pluginOptions' => [
                        'allowClear' => true,
//                        'depends' => ['group'],
//                        'url' => Url::to(['get-category']),
                    ],
                ])->label(false);
                ?>
            </div>
            <div class="col-md-4">
                <?
                echo $form->field($main, 'group_id')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'options' => ['id' => 'group_id', 'placeholder' => 'Sub kategoriya', 'class' => 'color_gray'],
                    'pluginOptions' => [
                        'depends' => ['category_id'],
                        'url' => Url::to(['get-subcategory']),
                    ]
                ])->label(false); ?>

            </div>
            <div class="col-md-4">
                <?

                echo $form->field($main, 'type_group_id')->widget(DepDrop::classname(), [
                    'type' => DepDrop::TYPE_SELECT2,
                    'options' => ['id' => 'type_id', 'placeholder' => 'Type', 'class' => 'color_gray'],
                    'pluginOptions' => [
                        'depends' => ['group_id'],
                        'url' => Url::to(['get-types']),
                        'allowClear' => true
                    ],
                    'pluginEvents' => [
                        'select2:select' => new JsExpression("function (e) {
                                refreshFilesBlock(e)
                      }")],


                ])->label(false);
                ?>
            </div>
            <div class="col-md-12">
                <?= $form->field($main, 'name_uz')->textInput() ?>
                <?= $form->field($main, 'doc_about')->textarea(['rows' => 6]) ?>
            </div>
        </div>
        <?php Pjax::begin(['id' => 'files_block']) ?>

        <div class="row">
            <div class="col-md-12">


            </div>
            <? if ($main->path) { ?>
            <div class="col-md-6">
                <label class="">Asosiy fayl</label>
                <?= $form->field($main, 'path')->hiddenInput()->label(false) ?>

                <div class="card">
                    <div class="card-body ">
                        <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                            <img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png"
                                 alt="">
                            <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                              <span id="installment-btn"
                                    class="showInstallmentModal"
                                    data-item="<?php echo $main->id ?>"
                                    data-href="<?php echo Url::to(['/documents/doc-view-template', 'id' => $type_id]) ?>">
                                             <button type="submit"
                                                     class="btn btn-success">Xujjatni ko'rish</button>
                             </span>

                                <!--                                --><? //= \yii\helpers\Html::a('Template', Url::to(['/installment/group/index', 'id' => $type_id,])) ?>
                                <!--                            <a target="_blank" href="doc-->
                                <? //= $main->path ?><!--"-->
                                <!--                               class=" mb-0">--><? //= $main->path ?><!-- </a>-->

                                <p class="text-muted mb-1">0.5 kb</p>
                                <!--                                <a href="" class="btn btn-outline-danger btn-fw mt-2">Delete</a>-->
                            </div>
                        </div>
                    </div
                </div>
            </div>
        </div>
    <? } ?>


        <!--        <div class="col-md-6 mb-4">-->
        <!--            <label for="">Qo'shimcha fayllar</label>-->
        <!--            --><? //
        //            echo FileInput::widget([
        //                'name' => 'attached',
        //                'options' => [
        //                    'multiple' => true,
        ////                    'accept' => 'images/*'
        //                ],
        //                'pluginOptions' => [
        //                    'showCaption' => false,
        //                    'uploadUrl' => Url::to(['upload-docs']),
        //                    'deleteUrl' => Url::to(['delete-docs']),
        //                    'allowedFileExtensions' => ['docx', 'doc', 'pdf', 'jpg', 'jpeg'],
        //                    'browseClass' => 'btn btn-success ',
        //                    'showCancel' => false,
        //                    'showClose' => false,
        //                    'showUpload' => true,
        //                    'maxFileSize' => 2240,
        //                    'maxFileCount' => 40,
        //                    'overwriteInitial' => false,
        //                    'initialPreviewAsData' => true,
        //                    'fileActionSettings' => [
        //                        'removeIcon' => '<i class="fa fa-trash"></i>',
        //                        'uploadIcon' => '<i class="fa fa-upload" aria-hidden="true"></i>',
        //                        'zoomIcon' => '<i class="fa fa-search-plus"></i>'
        //                    ],
        //                ],
        //
        //
        //                'pluginEvents' => [
        //                    'fileuploaded' => new JsExpression('function(event, data, previewId) {
        //                             console.log(previewId)
        //
        //                            uploaded.value = JSON.stringify( data.response);
        //                        }'),
        //                    'filedeleted' => new JsExpression('function(event, key) {
        //                            deletedImages.push(key);
        //                            deleted.value = JSON.stringify(deletedImages);
        //                        }'),
        //                    'filesuccessremove' => new JsExpression('function(event, previewId) {
        //                            delete uploadedImages[previewId];
        //                            uploaded.value = JSON.stringify(uploadedImages);
        //                        }'),
        //                    'filesorted' => new JsExpression('function(event, params) {
        //                            sorted.value = JSON.stringify(params.stack);
        //                        }')
        //                ]
        //            ]) ?>
        <!--        </div>-->

    </div>

<?php Pjax::end() ?>

    <button type="submit" class="btn btn-success mt-3 btn-fw">Keyingi Bosqish</button>


<?php ActiveForm::end(); ?>


<?php Modal::begin([
    'title' => '<span class="modal-header-main">Template </span>',
    'id' => 'modalInstallment',
    'size' => 'modal-dialog modal-xl',
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