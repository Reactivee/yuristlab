<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="container py-5">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <h1><?= Html::encode($this->title) ?></h1>

            <p>Please fill out the following fields to login:</p>
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="my-1 mx-0" style="color:#999;">
                <!--                If you forgot your password you can -->
                <? //= Html::a('reset it', ['site/request-password-reset']) ?><!--.-->
                <!--                <br>-->
<!--                Ro'yhatdan o'tmagan bo'lsangiz --><?//= Html::a('Ro\'yhatdan o\'tish', ['site/signup']) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Tizimga kirish', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                <?= Html::a("Ro'yhatdan o'tish", ['site/signup'], ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-3"></div>

    </div>
</div>

