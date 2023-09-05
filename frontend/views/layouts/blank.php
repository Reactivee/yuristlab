<?php

/** @var yii\web\View $this */
/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon.ico">
    <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon.ico">
    <link rel="mask-icon" href="/images/favicon.ico">
    <meta property="og:site_name" content="YuristLab">
    <meta property="og:title" content="YuristLab">
    <meta property="og:locale" content="uz">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<main role="main" style="overflow: auto">
    <div class="container-fluid">
        <?= Alert::widget() ?>

        <?= $content ?>
    </div>
</main>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
