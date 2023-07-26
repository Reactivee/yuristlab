<?php

use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Employ $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employ-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

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

    <?= $form->field($model, 'key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'type')->textInput() ?>

    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photo')->textInput(['maxlength' => true]) ?>

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
    ]);

    //    $form->field($model, 'company_id')->dropDownList()    ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'login')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
