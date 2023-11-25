<?php

use common\models\news\LawNews;
use floor12\summernote\Summernote;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\news\LawContent $model */
/** @var yii\widgets\ActiveForm $form */
$category = LawNews::find()->all();
$category = ArrayHelper::map($category, 'id', 'title_uz');

?>

<div class="law-content-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'law_id')->dropDownList($category) ?>

    <?= $form->field($model, 'title_uz')->textInput(['maxlength' => true]) ?>

    <!--    --><? //= $form->field($model, 'title_ru')->textInput(['maxlength' => true]) ?>

    <?
    echo $form->field($model, 'text_uz')->textarea(['row' => 10])
    //
    //    echo $form->field($model, 'text_uz')->widget(Summernote::class, [
    //        'clientOptions' => [
    //            // ...
    //        ]
    //    ]);
    //
    //    echo $form->field($model, 'text_ru')->widget(Summernote::class, [
    //        'clientOptions' => [
    //            // ...
    //        ]
    //    ]);
    ?>
    <?= $form->field($model, 'status')->dropDownList($model->getStatusName()) ?>

    <?= $form->field($model, 'image')->fileInput(['maxlength' => true, 'value' => $model->image])
        ->label('Document') ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
