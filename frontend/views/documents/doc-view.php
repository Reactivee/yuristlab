<?

use common\models\documents\MainDocument;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */

$domen = Url::base('https');
$permit = false;

$exist = in_array($model->status, $model->visibleEditWord());

if ($exist) {
    $permit = true;
}

if (Yii::$app->user->identity->employ->role == \common\models\Employ::LAWYER && $model->status == MainDocument::SIGNING) {
    $permit = true;
}

?>
<div class="row">
    <div class="container-fluid px-5">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',], 'action' => '/documents/doc-edit']) ?>

        <?= $form->field($model, 'path')->hiddenInput()->label(false) ?>
        <? if ($permit) { ?>
            <button type="submit" class="btn btn-outline-primary btn-icon-text my-3">
                <i class="mdi mdi-file-check btn-icon-prepend"></i>Tahrirlash
            </button>
        <? } ?>

        <?

        ?>
        <?php ActiveForm::end() ?>
        <!--        <a href="doc-edit" type="button" class="btn btn-outline-primary btn-icon-text my-3 ">-->
        <!--            <i class="mdi mdi-file-check btn-icon-prepend"></i>-->
        <!--            Kengaytirilgan-->
        <!--        </a>-->


        <!--        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=-->
        <? //= $domen . $model->path ?><!--'-->
        <!--                width='100%' height='900px' frameborder='0'>-->
        <!--        </iframe>-->

        <?php

        echo \lesha724\documentviewer\GoogleDocumentViewer::widget([
            'url' => $domen . $model->path,//url на ваш документ
            'width' => '100%',
            'height' => '900px',
            //https://geektimes.ru/post/111647/
            'embedded' => true,
            'a' => \lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
        ]);
        ?>
    </div>
</div>



