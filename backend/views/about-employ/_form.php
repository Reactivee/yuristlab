<?php

use kartik\date\DatePicker;

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\user\AboutEmploy $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="about-employ-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'text_ru')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'text_uz')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'key')->textInput() ?>

    <?= $form->field($model, 'text')->textarea(['rows' => 6]);


    ?>
    <?= $form->field($model, 'employ_id')->dropDownList($model->getEmploy()) ?>

<!--    --><?php //echo $form->field($model, 'begin_date')->widget(
//        DatePicker::className(), [
//            'name' => 'begin_date',
//            'type' => DatePicker::TYPE_COMPONENT_APPEND,
//            'value' => '23-Feb-1982',
//            'pluginOptions' => [
//                'autoclose' => true,
//                'format' => 'dd-M-yyyy'
//            ]
//        ]
//    ) ?>

<!--    --><?php //echo $form->field($model, 'end_date')->widget(
//        DatePicker::className(), [
//            'name' => 'begin_date',
//            'type' => DatePicker::TYPE_COMPONENT_APPEND,
//            'value' => '23-Feb-1982',
//            'pluginOptions' => [
//                'autoclose' => true,
//                'format' => 'dd-M-yyyy'
//            ]
//        ]
//    ) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
