<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-4">
            <?php echo $form->field($model, 'username')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'first_name')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'phone')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'last_name')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'email')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'address')->textInput() ?>

        </div>
        <div class="col-md-4">
            <?php echo $form->field($model, 'password')->passwordInput() ?>

        </div>

        <div class="col-md-4">
            <?php echo $form->field($model, 'role')->dropDownList(\common\models\User::getRoleText()) ?>

        </div>

    </div>

    <div class="form-group">
        <?php echo Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
