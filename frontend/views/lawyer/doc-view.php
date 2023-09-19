<?

use common\models\documents\MainDocument;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */

$domen = Url::base('https');
$permit = false;

?>

<div class="row">
    <div class="container-fluid px-5">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data',], 'action' => '/lawyer/doc-edit']) ?>

        <?= $form->field($model, 'lawyer_conclusion_path')->hiddenInput()->label(false) ?>

        <button type="submit" class="btn btn-outline-primary btn-icon-text my-3">
            <i class="mdi mdi-file-check btn-icon-prepend"></i>Tahrirlash
        </button>

        <?php ActiveForm::end() ?>

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



