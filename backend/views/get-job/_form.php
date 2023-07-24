<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\GetJob $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="get-job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'job_id')->dropDownList($model->getAllJob()) ?>

<!--    --><?//= $form->field($model, 'user_id')->textInput() ?>

    <?= $form->field($model, 'employ_id')->dropDownList($model->getAllEmploy()) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
