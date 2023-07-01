<?php

use common\models\documents\CategoryDocuments;
use common\models\documents\TypeDocuments;
use floor12\summernote\Summernote;

//use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;


/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="main-document-form p-5">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'doc_about')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(CategoryDocuments::getCategory()) ?>

    <?= $form->field($model, 'type_group_id')->dropDownList(TypeDocuments::getTypeDoc()) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusName()) ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>

    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'created_by')->textInput() ?>


    <?= Html::a('Xujjatni korish', ['doc-view', 'id' => $model->id]);
//    $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'time_begin')->textInput() ?>

    <!--    --><? //=   $form->field($model, 'path')->widget(Summernote::class, [
    ////        'useKrajeePresets' => true,
    //        // other widget settings
    //    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
