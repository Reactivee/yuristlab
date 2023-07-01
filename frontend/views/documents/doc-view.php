<?

use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */

$domen = Url::base('https');
?>
<div class="row">
    <div class="container-fluid px-5">
        <button type="button" class="btn btn-outline-primary btn-icon-text my-3 ">
            <i class="mdi mdi-file-check btn-icon-prepend"></i>
            Kengaytirilgan
        </button>

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

