<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;

$bundle = yiister\gentelella\assets\Asset::register($this);
\Yii::$app->language = 'ru-RU';
?>
<?php $this->beginPage(); ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <?= Html::csrfMetaTags() ?>
    <title>Yuristlab</title>
    <?php $this->head() ?>
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="nav-<?= !empty($_COOKIE['menuIsCollapsed']) && $_COOKIE['menuIsCollapsed'] == 'true' ? 'sm' : 'md' ?>">
<?php $this->beginBody(); ?>
<div class="container body">

    <div class="main_container">
        <?php echo \common\widgets\Alert::widget() ?>
        <!--        --><?php //echo Breadcrumbs::widget([
        //            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        //        ]) ?>
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="/home" class="site_title"><i class="fa fa-paw"></i> <span>Yuristlab</span></a>
                </div>


                <div class="clearfix"></div>



                <br/>

                <!-- sidebar menu -->
                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                    <div class="menu_section">
                        <?=
                        \yiister\gentelella\widgets\Menu::widget(
                            [
                                "items" => [
                                    ["label" => "News", "url" => "#", "icon" => "files-o",
                                        "items" => [
                                            ['label' => 'New cat', 'icon' => 'text_format', 'url' => ['/category-news']],
                                            ['label' => 'New content', 'icon' => 'file-image-o', 'url' => ['/content-news']],

                                        ],
                                    ],
                                    ["label" => "Laws news", "url" => "#", "icon" => "files-o",
                                        "items" => [
                                            ['label' => 'Laws Category', 'icon' => 'text_format', 'url' => ['/law-news']],
                                            ['label' => 'Laws Content', 'icon' => 'text_format', 'url' => ['/law-content']],
                                        ],
                                    ],
                                    ['label' => 'Category', 'icon' => 'files-o', 'url' => ['/category-documents']],
                                    ['label' => 'Group', 'icon' => 'th-large', 'url' => ['/group-documents']],
//                                    ['label' => 'Main Doc', 'icon' => 'files-o', 'url' => ['/main-document']],
                                    ['label' => 'Type Category', 'icon' => 'file-o', 'url' => ['/type-document']],

                                    ['label' => 'Recommend category', 'icon' => 'files-o', 'url' => ['/category-recommendation']],
                                    ['label' => 'Recommend content', 'icon' => 'files-o', 'url' => ['/content-recommendation']],
                                    ['label' => 'Jobs', 'icon' => 'text_format', 'url' => ['/jobs']],
                                    ['label' => 'Get job', 'icon' => 'text_format', 'url' => ['/get-job']],

                                    ["label" => "User info", "url" => "#", "icon" => "user",
                                        "items" => [
                                            ['label' => 'Company', 'icon' => 'text_format', 'url' => ['/company']],
                                            ['label' => 'Xodimlar', 'icon' => 'text_format', 'url' => ['/employ']],
                                            ['label' => 'Xodimlar haqida', 'icon' => 'text_format', 'url' => ['/about-employ']],
                                            ['label' => 'Hobby', 'icon' => 'text_format', 'url' => ['/hobbies']],
                                            ['label' => 'Tarmoqlar', 'icon' => 'text_format', 'url' => ['/social-employ']],


                                        ],
                                    ],


                                ],
                            ]
                        )
                        ?>
                    </div>

                </div>
                <!-- /sidebar menu -->

                <!-- /menu footer buttons -->
                <div class="sidebar-footer hidden-small">
                    <a data-toggle="tooltip" data-placement="top" title="Settings">
                        <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="FullScreen">
                        <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                    </a>
                    <a data-toggle="tooltip" data-placement="top" title="Lock">
                        <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
                    </a>

                    <?php echo Html::a('  <span class="glyphicon glyphicon-off" aria-hidden="true"></span>',
                        ['/site/logout'], ['data-method' => 'POST']) ?>


                </div>
                <!-- /menu footer buttons -->
            </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">

            <div class="nav_menu">
                <nav class="" role="navigation">
                    <div class="nav toggle">
                        <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                    </div>

                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!Yii::$app->user->isGuest) { ?>
                            <li class="dropdown user user-menu">
                                <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-user"></i>
                                    <span class="hidden-xs"><?php echo Yii::$app->user->identity['username'] ?></span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><?php echo Html::a('Profile ',
                                            ['/admin/user/profile']) ?></li>
                                    <li>
                                        <?php echo Html::a('Change password',
                                            ['/admin/user/change-password']) ?></li>
                                    <!---->
                                    <li>
                                        <?php echo Html::a('Change username',
                                            ['/admin/user/change-username']) ?></li>
                                    <li>
                                        <?php echo Html::a('Sign out',
                                            ['/site/logout'], ['data-method' => 'POST']) ?></li>
                                </ul>
                            </li>
                        <?php } ?>


                    </ul>
                </nav>
            </div>

        </div>
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
            <?php if (isset($this->params['h1'])): ?>
                <div class="page-title">
                    <div class="title_left">
                        <h1><?= $this->params['h1'] ?></h1>
                    </div>
                    <div class="title_right">
                        <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search for...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">Go!</button>
                            </span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
            <div class="clearfix"></div>
            <?php echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],]) ?>
            <?= $content ?>
        </div>
        <!-- /page content -->
        <!-- footer content -->
        <footer>
            <div class="pull-left">
                Elegant Technologies <a href="#" rel="nofollow" target="_blank"></a><br/>
            </div>
            <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
    </div>

</div>

<div id="custom_notifications" class="custom-notifications dsp_none">
    <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
    </ul>
    <div class="clearfix"></div>
    <div id="notif-group" class="tabbed_notifications"></div>
</div>
<!-- /footer content -->
<?php $this->endBody(); ?>
</body>
</html>
<?php $this->endPage(); ?>
