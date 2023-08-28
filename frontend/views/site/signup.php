<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap4\ActiveForm $form */

/** @var \frontend\models\SignupForm $model */

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

$this->title = "Ro'yhatdan o'tish";
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="particles-js " id="particles-js"></div>

<div class="sign_wrapper overflow-hidden">
    <div class="wrap_sign_bg overflow-hidden">

        <div class="row ">
            <!--                <div class="col-md-2">/</div>-->
            <div class="col-md-6">
                <div class="login_form">
                <h1 class="text-success font-weight-bold text-center"><?= Html::encode($this->title) ?></h1>

<!--                <p>Please fill out the following fields to signup:</p>-->
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('FIO') ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Login') ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Telefon Nomer') ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Passport seriya') ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <div class="form-group">
                    <?= Html::submitButton('Tasdiqlash', ['class' => 'btn btn-success', 'name' => 'signup-button']) ?>
                </div>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <div class="col-md-6 d-flex align-items-center">
                <img class="w-100" src="/images/short_logo.png" alt="">
            </div>
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
