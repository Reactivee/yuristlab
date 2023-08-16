<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\models\documents\MainDocument;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Html;


$status_id = Yii::$app->request->getQueryParam('status');

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <!--<header>-->
    <?php
    //    NavBar::begin([
    //        'brandLabel' => Yii::$app->name,
    //        'brandUrl' => Yii::$app->homeUrl,
    //        'options' => [
    //            'class' => 'navbar navbar-expand-md navbar-dark bg-dark fixed-top',
    //        ],
    //    ]);
    //    $menuItems = [
    //        ['label' => 'Home', 'url' => ['/site/index']],
    //        ['label' => 'About', 'url' => ['/site/about']],
    //        ['label' => 'Contact', 'url' => ['/site/contact']],
    //    ];
    //    if (Yii::$app->user->isGuest) {
    //        $menuItems[] = ['label' => 'Signup', 'url' => ['/site/signup']];
    //    }
    //
    //    echo Nav::widget([
    //        'options' => ['class' => 'navbar-nav me-auto mb-2 mb-md-0'],
    //        'items' => $menuItems,
    //    ]);
    //    if (Yii::$app->user->isGuest) {
    //        echo Html::tag('div',Html::a('Login',['/site/login'],['class' => ['btn btn-link login text-decoration-none']]),['class' => ['d-flex']]);
    //    } else {
    //        echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
    //            . Html::submitButton(
    //                'Logout (' . Yii::$app->user->identity->username . ')',
    //                ['class' => 'btn btn-link logout text-decoration-none']
    //            )
    //            . Html::endForm();
    //    }
    //    NavBar::end();
    ?>
    <!--</header>-->

    <!--<main role="main" class="flex-shrink-0">-->
    <!--    <div class="container">-->
    <!--        --><? //= Breadcrumbs::widget([
    //            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    //        ]) ?>

    <div class="container-scroller_">

        <div class="preloader js-preloader flex-center">
            <div class="loader-demo-boxs">
                <div class="dot-opacity-loader">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>

        <?= $this->render('top') ?>


        <div class="container-fluid page-body-wrapper">

            <?= $this->render('left') ?>

            <div class="main-panel">
                <div class="content-wrapper p-0">
                    <?= Alert::widget() ?>

                    <div class="d-sm-flex justify-content-between align-items-center border-bottom">

                        <ul class="nav nav-tabs home-tab" role="tablist">
                            <? foreach (MainDocument::getStatusNameArr() as $key => $item) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $status_id == $key ? 'active' : '' ?>" id="Dashboards-tab"
                                       href="/documents?status=<?= $key ?>"
                                       aria-controls="Dashboards-1" aria-selected="false"><?= $item ?>
                                        <span class=" ml-2<?= MainDocument::getStatusNameColorRound($key) ?>"><?= MainDocument::getByStatusDocuments($key) ?? '' ?></span>
                                    </a>
                                </li>

                            <? } ?>
                        </ul>


                    </div>

                    <?= $content ?>

                </div>
                <!-- content-wrapper ends -->
            </div>
        </div>
    </div>


    <!--    </div>-->
    <!--</main>-->

    <!--<footer class="footer mt-auto py-3 text-muted">-->
    <!--    <div class="container">-->
    <!--        <p class="float-start">&copy; --><?//= Html::encode(Yii::$app->name) ?><!-- -->
    <?//= date('Y') ?><!--</p>-->
    <!--        <p class="float-end">--><?//= Yii::powered() ?><!--</p>-->
    <!--    </div>-->
    <!--</footer>-->


    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage();
