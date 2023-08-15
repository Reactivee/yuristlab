<?

use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */

$domen = Url::base('https');
$templateFile = Yii::getAlias('@frontend') . '/web/' . $model->path;
$res = file_get_contents($templateFile);

?>
<div class="row">


    <!--    <input id="files" type="file" value=""/>-->
    <!--    <input type="button" id="btnPreview" value="Preview Word Document" onclick="PreviewWordDoc()"/>-->
    <!--    <div id="word-container" class=""></div>-->

    <div class="container-fluid px-5">
        <!--        <iframe src='https://view.officeapps.live.com/op/embed.aspx?src=-->
        <? //= $domen . $model->path?><!--'-->
        <!--                width='100%' height='900px' >-->
        <!--        </iframe>-->

        <?php echo \lesha724\documentviewer\GoogleDocumentViewer::widget([
            'url' => $domen . $model->path,//url на ваш документ
            'width' => '100%',
            'height' => '900px',
            //https://geektimes.ru/post/111647/
            'embedded' => true,
            'a' => \lesha724\documentviewer\GoogleDocumentViewer::A_V //A_V = 'v', A_GT= 'gt', A_BI = 'bi'
        ]);
        ?>
    </div>
</div>

