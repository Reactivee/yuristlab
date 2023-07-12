<?php

use floor12\summernote\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\news\LawContent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="law-content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'law_id')->textInput() ?>

    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?

    echo $form->field($model, 'text_uz')->widget(Summernote::class, [
        'clientOptions' => [
            // ...
        ]
    ]);

    echo $form->field($model, 'text_ru')->widget(Summernote::class, [
        'clientOptions' => [
            // ...
        ]
    ]);
    ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
