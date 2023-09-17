<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\models\documents\MainDocument;
use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap4\Html;


$status_id = Yii::$app->request->getQueryParam('status');
// Yii::$app->session['shift']=6;
//dd(Yii::$app->session['shift']);
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>" class="h-100">
    <head>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php $this->registerCsrfMetaTags() ?>
        <?php echo Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
        <link rel="apple-touch-icon" sizes="180x180" href="/images/favicon.ico">
        <link rel="apple-touch-icon" sizes="152x152" href="/images/favicon.ico">
        <link rel="apple-touch-icon" sizes="144x144" href="/images/favicon.ico">
        <link rel="mask-icon" href="/images/favicon.ico">
        <meta property="og:site_name" content="YuristLab">
        <meta property="og:title" content="YuristLab">
        <meta property="og:locale" content="uz">
        <?php $this->head() ?>
    </head>
    <body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>


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


        <div class="container-fluid page-body-wrapper  overflow-hidden">
            <!--            <div class="row">-->
            <!--                <div class="col-3">-->
            <?= $this->render('left') ?>

            <!--                </div>-->
            <!--                <div class="col-9">-->
            <div style="margin-left: 270px" class="main-panel">
                <div class="content-wrapper p-0">
                    <?= Alert::widget() ?>

                    <div class="d-sm-flex justify-content-between align-items-center border-bottom">

                        <ul class="nav nav-tabs home-tab" role="tablist">
                            <? foreach (MainDocument::getStatusNameArr() as $key => $item) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $status_id == $key ? 'active' : '' ?>"
                                       id="Dashboards-tab"
                                       href="/documents/all/?status=<?= $key ?>"
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

            <!--                </div>-->

            <!--            </div>-->
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
