<?

use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */

$domen = Url::base('https');

?>
<div class="row">
    <div class="container-fluid px-5">
        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'], 'action' => 'doc-edit']) ?>

        <!--        --><? //= $form->field($model, 'path')->textInput() ?>

        <button type="submit" class="btn btn-outline-primary btn-icon-text my-3 ">Kengaytirilgan</button>
        <?=
        $form->field($model, 'path')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'initialPreview' => [
                    "https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
                    "https://upload.wikimedia.org/wikipedia/commons/thumb/6/6f/Earth_Eastern_Hemisphere.jpg/600px-Earth_Eastern_Hemisphere.jpg"
                ],
                'initialPreviewAsData' => true,
                'initialCaption' => "The Moon and the Earth",
                'initialPreviewConfig' => [
                    ['caption' => 'Moon.jpg', 'size' => '873727'],
                    ['caption' => 'Earth.jpg', 'size' => '1287883'],
                ],
                'overwriteInitial' => false,
                'maxFileSize' => 2800
            ]
        ]);
        ?>
        <?php ActiveForm::end() ?>
        <a href="doc-edit" type="button" class="btn btn-outline-primary btn-icon-text my-3 ">
            <i class="mdi mdi-file-check btn-icon-prepend"></i>
            Kengaytirilgan
        </a>

        <?php
        echo \lesha724\documentviewer\GoogleDocumentViewer::widget([
            'url' => $domen . $model->path,//url на ваш документ
            'width' => '100%',
            'height' => '600px',
            //https://geektimes.ru/post/111647/
            'embedded' => true,
            'a' => \lesha724\documentviewer\GoogleDocumentViewer::A_BI //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
        ]);
        ?>
    </div>
</div>

