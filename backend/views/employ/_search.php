<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\EmploySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employ-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'first_name') ?>

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'user_id') ?>

    <?php // echo $form->field($model, 'key') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'photo') ?>

    <?php // echo $form->field($model, 'company_id') ?>

    <?php // echo $form->field($model, 'role') ?>

    <?php // echo $form->field($model, 'login') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
