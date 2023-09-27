<?php

use kartik\file\FileInput;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Employ $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employ-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true])->label('Ism') ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true])->label('Familya') ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatus()) ?>

    <?= $form->field($model, 'user_id')->widget(
        Select2::classname(), [
            'data' => $model->getAllUser(),
            'theme' => Select2::THEME_BOOTSTRAP,
            'options' => [
                'placeholder' => 'Select provinces ...',
                'multiple' => false,
                'allowClear' => true
            ],
            'pluginOptions' => [
                'allowClear' => true,
            ],]
    ) ?>


    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>


    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'passport')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'inn')->textInput(['maxlength' => true]) ?>







    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>
    <?=
    $form->field($model, 'company_id')->widget(Select2::classname(), [
        'data' => $model->getAllCompany(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => [
            'placeholder' => 'Select provinces ...',
            'multiple' => false,
            'allowClear' => true
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('Tashkilot');

    //    $form->field($model, 'company_id')->dropDownList()         ?>
    <?=
    $form->field($model, 'role')->widget(Select2::classname(), [
        'data' => \common\models\Employ::getRole(),
        'theme' => Select2::THEME_BOOTSTRAP,
        'options' => [
            'placeholder' => 'Select provinces ...',
            'multiple' => false,
            'allowClear' => true
        ],
        'pluginOptions' => [
            'allowClear' => true,
        ],
    ])->label('lavozim');

    //    $form->field($model, 'role')->dropDownList(\common\models\Employ::getRole())   ?>
    <?=
    $form->field($model, 'photo')->widget(FileInput::classname(), [
        'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'maxFileSize' => 1800,
            'initialPreviewAsData' => true,
        ]
    ]); ?>
    <?= $form->field($model, 'telegram')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'instagram')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'facebook')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'other')->textInput(['maxlength' => true]) ?>


    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
