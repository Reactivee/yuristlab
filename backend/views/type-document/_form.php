<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\documents\TypeDocuments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="type-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->dropDownList(\common\models\documents\CategoryDocuments::subGetCategory()) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>

    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>

    <?=
    $form->field($model, 'path')->widget(FileInput::classname(), [
        'id' => 'path',
        'options' => ['accept' => 'doc/*'],
        'pluginOptions' => [
            'showCaption' => false,
        ]
    ])->label(false);
    //    $form->field($model, 'path')->textInput(['maxlength' => true])  ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
