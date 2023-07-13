<?php

/* @var $this View */

use common\widgets\LanguageSwitcherWidget;
use yii\helpers\Url;
use yii\helpers\Html;
use rmrevin\yii\fontawesome\FA;
use common\components\languagepicker\widgets\LanguagePicker;
use yii\web\View;

?>

<header class="main-header">

    <?php echo Html::a('<span class="logo-mini"><i class="fa fa-dashboard"></i></span><span class="logo-lg"><i class="fa fa-dashboard"></i>&nbsp;'
        . Yii::t('views', 'Dashboard') . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <?php echo Html::button('<span class="sr-only"></span>', [
            'role' => 'button',
            'class' => 'sidebar-toggle',
            'data-toggle' => 'offcanvas',
            'onclick' => '$.ajax({type : "GET", url : "' . Url::to(['/site/session-sidebar']) . '"}); return false;',
        ]) ?>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <?php if (Yii::$app->params['multiLanguages']) { ?>
                    <li class="dropdown lang-menu">
                        <div class="header-language-picker">
                            <?php echo LanguagePicker::widget([
                                'skin' => LanguagePicker::SKIN_BUTTON,
                                'size' => LanguagePicker::SIZE_LARGE,
                            ]) ?>
                        </div>
                    </li>
                <?php } ?>

                <?php if (!Yii::$app->user->isGuest) { ?>
                    <li class="dropdown user user-menu">
                        <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-user"></i>
                            <span class="hidden-xs"><?php echo Yii::$app->user->identity['username'] ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><?php echo Html::a('<i class="far fa-address-card"></i>' . Yii::t('views', 'Profile'),
                                    ['/admin/user/profile']) ?></li>
                            <li><?php echo Html::a('<i class="fa fa-exchange"></i>' . Yii::t('views', 'Change password'),
                                    ['/admin/user/change-password']) ?></li>
                            <li><?php echo Html::a('<i class="fa fa-exchange"></i>' . Yii::t('views', 'Change username'),
                                    ['/admin/user/change-username']) ?></li>
                            <li><?php echo Html::a('<i class="fa fa-sign-out"></i>' . Yii::t('views', 'Sign out'),
                                    ['/site/logout'], ['data-method' => 'POST']) ?></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </nav>
</header>
