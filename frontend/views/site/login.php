<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \common\models\LoginForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Tizimga kirish';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="particles-js overflow-hidden" id="particles-js"></div>

<div class="login_wrapper ">
    <!-- particles.js container -->
    <div class="row align-items-center">
        <div class="col-md-6 ">
            <div class="login_form">
                <h1 class="text-success font-weight-bold text-center"><?= Html::encode($this->title) ?></h1>
                <!--                <p>Please fill out the following fields to login:</p>-->
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Login') ?>

                <?= $form->field($model, 'password')->passwordInput()->label('Parol') ?>

                <?= $form->field($model, 'rememberMe')->checkbox()->label('Meni eslab qol') ?>

                <div class="my-1 mx-0" style="color:#999;">
                    <!--                If you forgot your password you can -->
                    <? //= Html::a('reset it', ['site/request-password-reset']) ?><!--.-->
                    <!--                <br>-->
                    <!--                Ro'yhatdan o'tmagan bo'lsangiz --><? //= Html::a('Ro\'yhatdan o\'tish', ['site/signup']) ?>
                </div>

                <div class="form-group">
                    <?= Html::submitButton('Tizimga kirish', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    <?= Html::a("Ro'yhatdan o'tish", ['site/signup'], ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
                </div>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-md-6">
            <img class="w-100" src="/images/short_logo.png" alt="">
        </div>
    </div>
</div>

<?php
$this->registerCssFile("/css/particles.css", [
    'depends' => [\yii\bootstrap\BootstrapAsset::class],

]);
$this->registerJsFile(
    'js/particles.min.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);
$this->registerJsFile(
    'js/particles_in.js',
    ['depends' => [\yii\web\JqueryAsset::class]]
);

?>

