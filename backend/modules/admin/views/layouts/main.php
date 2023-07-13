<?php

/* @var $this View */
/* @var $content string */

use yii\helpers\Html;
use backend\assets\AppAsset;
use backend\extensions\adminlte\components\AdminLteHelper;
use yii\web\View;

\backend\assets\AdminAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?php echo Yii::$app->language ?>">
<head>
    <meta charset="<?php echo Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php echo Html::csrfMetaTags() ?>
    <title><?php echo Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">

</head>

<?php if (Yii::$app->controller->action->id === 'login') { ?>

    <body class="login-page">
    <?php $this->beginBody() ?>

    <?php echo $this->render('login.php', ['content' => $content]) ?>

    <?php $this->endBody() ?>
    </body>

<?php } else { ?>

    <?php $sidebar = Yii::$app->session['sidebar'] ? ' sidebar-collapse' : ''; ?>
    <body class="<?php echo AdminLteHelper::skinClass() . $sidebar ?> sidebar-mini">
    <?php $this->beginBody() ?>
    <div class="wrapper">

        <?php echo $this->render('header.php') ?>
        <?php echo $this->render('left.php') ?>
        <?php echo $this->render('content.php', ['content' => $content]) ?>

    </div>
    <div id="overlay"></div>
    <?php $this->endBody() ?>
    </body>

<?php } ?>

</html>
<?php $this->endPage() ?>
