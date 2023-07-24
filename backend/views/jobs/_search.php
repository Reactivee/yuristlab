<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\JobsSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="jobs-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name_uz') ?>

    <?= $form->field($model, 'name_ru') ?>

    <?= $form->field($model, 'status') ?>

    <?= $form->field($model, 'key') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
