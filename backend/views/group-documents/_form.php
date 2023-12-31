<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\documents\GroupDocuments $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="group-documents-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList(\common\models\documents\GroupDocuments::getStatusName()) ?>
    <?= $form->field($model, 'key')->textInput() ?>
    <?=
    $form->field($model, 'path')->widget(FileInput::classname(), [
        'id' => 'path',
        'options' => ['accept' => 'doc/*'],
        'pluginOptions' => [
            'showCaption' => false,
        ]
    ])->label(false);
    ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>

    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
