<?php

use common\models\documents\GroupDocuments;
use yii\helpers\Html;

$group = GroupDocuments::find()->all();
$arr_group = \yii\helpers\ArrayHelper::map($group, 'id', 'name_uz');
?>
<nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="navbar-brand-wrapper align-items-center">
        <a class="navbar-brand brand-logo" href="/"><img src="../../images/logo.png" alt="logo"/></a>
        <!--        <a class="navbar-brand brand-logo-mini" href="/"><img src="../../images/logo.png" alt="logo"/></a>-->
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-sort-variant"></span>
        </button>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item d-none d-sm-block dropdown arrow-none">
                <!--                <button type="button" class="btn btn-success btn-icon-text dropdown-toggle" data-toggle="dropdown"-->
                <!--                        id="profileDropdown6" aria-expanded="false">-->
                <!--                    <i class="mdi mdi-plus-circle btn-icon-prepend"></i>-->
                <!--                    Yangi xujjat qo'shish-->
                <!--                </button>-->
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown" aria-labelledby="profileDropdown6">

                    <!--                    <a class="dropdown-item text-primary">-->
                    <!--                        <i class="mdi mdi-sale"></i> Territory sales-->
                    <!--                    </a>-->
                    <!--                    <a class="dropdown-item text-primary">-->
                    <!--                        <i class="mdi mdi-account-card-details"></i> sales order details-->
                    <!--                    </a>-->
                    <!--                    <a class="dropdown-item text-primary">-->
                    <!--                        <i class="mdi mdi-counter"></i> Product Line sales-->
                    <!--                    </a>-->
                    <!--                    --><? //
                    //                    foreach ($arr_group as $key => $item) { ?>
                    <!--                        <a class="dropdown-item text-primary" href="/create?doc=-->
                    <? //= $key ?><!-- ">-->
                    <!--                            <i class="mdi mdi-file-document"></i>-->
                    <!--                            --><? //= $item ?>
                    <!--                        </a>-->
                    <!--                    --><? // } ?>

                </div>
            </li>

        </ul>
        <? if (Yii::$app->user->identity->employ->id == Yii::$app->user->identity->employ->company->director) { ?>
            <span class="font-weight-bold  ml-2">Tashkilot: <?= Yii::$app->user->identity->employ->company->name_uz ?></span>
            <span class="font-weight-bold text-warning mx-2"> Lavozim:</span>
            <span class=" font-weight-bold text-success">( Rahbar )</span>

        <? } else { ?>
            <span class="font-weight-bold text-warning mx-2">Lavozim:</span>
            <span class="font-weight-bold text-success "> <?= \common\models\Employ::getRole(Yii::$app->user->identity->employ->role); ?></span>

        <? } ?>
        <ul class="navbar-nav navbar-nav-right">
            <li class="nav-item count-indicator nav-profile dropdown">
                <span class="count">3</span>
                <a class="nav-link  d-flex align-items-center dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                    <span class="nav-profile-name font-weight-bold"><?= Yii::$app->user->identity->employ->first_name . " " . Yii::$app->user->identity->employ->last_name ?></span>
                    <img src="https://via.placeholder.com/36x36" alt="profile"/>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                    <?php echo Html::a('<i class="mdi mdi-settings"></i> Settings ',
                        ['/user/index',], ['class' => 'dropdown-item text-primary']) ?>
                    <?php echo Html::a('<i class="mdi mdi-message"></i> Message ',
                        ['/user/index',], ['class' => 'dropdown-item text-primary']) ?>
                    <?php echo Html::a('<i class="fas fa-sign-out"></i>Sign out',
                        ['/site/logout'], ['data-method' => 'POST', 'class' => 'dropdown-item text-primary']) ?>
                </div>
            </li>
            <li class="nav-item dropdown count-indicator arrow-none">
                <span class="count bg-success">3</span>
                <a class="nav-link dropdown-toggle d-flex align-items-center justify-content-center"
                   id="notificationDropdown" href="#" data-toggle="dropdown">
                    <i class="mdi mdi-bell-outline mx-0"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list"
                     aria-labelledby="notificationDropdown">
                    <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-success">
                                <i class="mdi mdi-information mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Application Error</h6>
                            <p class="font-weight-light small-text mb-0">
                                Just now
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-warning">
                                <i class="mdi mdi-settings mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">Settings</h6>
                            <p class="font-weight-light small-text mb-0">
                                Private message
                            </p>
                        </div>
                    </a>
                    <a class="dropdown-item preview-item">
                        <div class="preview-thumbnail">
                            <div class="preview-icon bg-info">
                                <i class="mdi mdi-account-box mx-0"></i>
                            </div>
                        </div>
                        <div class="preview-item-content">
                            <h6 class="preview-subject font-weight-normal">New user registration</h6>
                            <p class="font-weight-light small-text mb-0">
                                2 days ago
                            </p>
                        </div>
                    </a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button"
                data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>
