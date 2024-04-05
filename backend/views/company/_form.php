<?php

use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Company $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name_ru')->textInput(['maxlength' => true]) ?>


    <!--    --><? //= $form->field($model, 'logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textInput(['maxlength' => true])->label('Manzil') ?>

    <!--    --><? //= $form->field($model, 'type')->textInput()->label('Turi') ?>
    <?= $form->field($model, 'post')->textInput()->label('Pochta') ?>
    <?= $form->field($model, 'bank')->textInput()->label('Bank nomi') ?>
    <?= $form->field($model, 'schot')->textInput()->label('Bank hisob') ?>
    <?= $form->field($model, 'mfo')->textInput()->label('MFO') ?>
    <?= $form->field($model, 'stir')->textInput()->label('STIR') ?>

    <!--    --><? //= $form->field($model, 'official')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'director')->dropDownList($model->getDir()) ?>
    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>


    <div class="col-md-6">
        <?=
        $form->field($model, 'template_doc')->widget(FileInput::classname(), [
            'id' => 'template_doc',
            'options' => ['accept' => 'docx/*'],
            'pluginOptions' => [
                'showCaption' => false,
            ]
        ])->label('shablon yuklash');
        ?>
    </div>
    <div class="col-md-6">
        <?=
        $form->field($model, 'logo')->widget(FileInput::classname(), [
            'id' => 'template_doc',
            'options' => ['accept' => 'png/*'],
            'pluginOptions' => [
                'showCaption' => false,
            ]
        ])->label('Logotip');
        ?>

    </div>
    <div class="form-group my-4">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <!--    --><? //= $form->field($model, 'status')->textInput() ?>



    <?php ActiveForm::end(); ?>

</div>
