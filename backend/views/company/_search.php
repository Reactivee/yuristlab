<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\CompanySearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="company-search">

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

    <?= $form->field($model, 'key') ?>

    <?= $form->field($model, 'logo') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'official') ?>

    <?php // echo $form->field($model, 'desc') ?>

    <?php // echo $form->field($model, 'director') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
