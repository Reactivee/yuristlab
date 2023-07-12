<?php

use floor12\summernote\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\documents\ContentNews $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="content-news-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>
    <?= $form->field($model, 'sub_title_uz')->textarea(['rows'=>5]) ?>
    <?= $form->field($model, 'sub_title_ru')->textarea(['rows'=>5]) ?>

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


    //    $form->field($model, '')->textarea(['rows' => 6])  ?>

    <!--    --><? //= $form->field($model, '')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'category_id')->dropDownList($model->getCategory()) ?>

    <?= $form->field($model, 'status')->dropDownList($model->getStatusName()) ?>
    <?= $form->field($model, 'path')->fileInput() ?>

    <!--    --><? //= $form->field($model, 'created_at')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'updated_at')->textInput() ?>
    <!---->
    <!--    --><? //= $form->field($model, 'created_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
