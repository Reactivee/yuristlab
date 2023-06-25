<?php

use floor12\summernote\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="main-document-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'category_id')->textInput() ?>

    <?= $form->field($model, 'group_id')->textInput() ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

<!--    --><?//= $form->field($model, 'path')->textInput(['maxlength' => true]) ?>

<!--    --><?//= $form->field($model, 'time_begin')->textInput() ?>

    <?=   $form->field($model, 'path')->widget(Summernote::class, [
//        'useKrajeePresets' => true,
        // other widget settings
    ]);?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
