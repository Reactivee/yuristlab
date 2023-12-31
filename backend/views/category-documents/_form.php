<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\documents\CategoryDocuments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?=

    $form->field($model, 'group_id')->widget(Select2::classname(), [
        'data' => $model->getAllGroup(),
        'options' => [
            'placeholder' => 'Select provinces ...',
            'multiple' => false,
            'allowClear' => true
        ],
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);
    $form->field($model, 'group_id')->textInput() ?>

    <?=
    $form->field($model, 'parent_id')->widget(Select2::classname(), [
        'data' => $model->getCategory(),
        'options' => [
            'placeholder' => 'Select provinces ...',
            'multiple' => false,
            'allowClear' => true
        ],
        'pluginOptions' => [
            'allowClear' => true,

        ],
    ]);

//    $form->field($model, 'parent_id')->dropDownList() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>

    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
