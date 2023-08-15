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
$cats = CategoryDocuments::getCategory($doc_id);


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
            <button type="button" class="btn btn-outline-info btn-fw mb-3"><?= $gr->name_uz ?></button>
        <? } ?>
        <div class="row">
            <? if ($cats) { ?>

                <div class="col-md-4">
                    <? echo $form->field($main, 'category_id')->widget(Select2::className(), [
                        'data' => CategoryDocuments::getCategory($doc_id),
                        'theme' => Select2::THEME_BOOTSTRAP,
                        'options' => ['placeholder' => 'Category', 'id' => 'category_id'],
                        'pluginOptions' => [
                            'allowClear' => true
                        ],
                    ])->label(false);
                    ?>
                </div>
                <div class="col-md-4">
                    <? echo $form->field($main, 'sub_category_id')->widget(DepDrop::classname(), [
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => ['id' => 'sub_category_id', 'placeholder' => 'Sub kategoriya', 'class' => 'color_gray'],
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
                            'depends' => ['sub_category_id'],
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
            <? } ?>
            <div class="col-md-12">
                <?= $form->field($main, 'name_uz')->textInput() ?>
                <?= $form->field($main, 'doc_about')->textarea(['rows' => 6]) ?>
            </div>
        </div>

        <?php Pjax::begin(['id' => 'files_block']) ?>

        <div class="row">

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

                                <? if ($doc_id) { ?>
                                    <span id="installment-btn"
                                          class="showInstallmentModal"
                                          data-item="<?php echo $main->id ?>"
                                          data-href="<?php echo Url::to(['/documents/group-view-template', 'id' => $doc_id]) ?>">
                                             <button type="submit"
                                                     class="btn btn-success"> <i class="fa fa-eye mr-2"></i>Xujjatni ko'rish</button>
                                       </span>
                                <? } else { ?>
                                    <span id="installment-btn"
                                          class="showInstallmentModal"
                                          data-item="<?php echo $main->id ?>"
                                          data-href="<?php echo Url::to(['/documents/doc-view-template', 'id' => $type_id]) ?>">
                                             <button type="submit"
                                                     class="btn btn-success"> <i class="fa fa-eye mr-2"></i> Xujjatni ko'rish</button>
                                    </span>
                                <? } ?>

<!--                                <a href="/frontend/web--><?//= $main->path ?><!--">Download</a>-->
<!--                                <p class="text-muted mb-1">0.5 kb</p>-->
                            </div>
                        </div>
                    </div
                </div>
            </div>
        </div>
    <? } ?>



    </div>

<?php Pjax::end() ?>

    <button type="submit" class="btn btn-success mt-3 btn-fw">Keyingi Bosqish</button>


<?php ActiveForm::end(); ?>


<?php Modal::begin([
    'title' => '<span class="modal-header-main">Xujjatni ko\'rish </span>',
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