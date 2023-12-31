<?php

use backend\modules\admin\components\Helper;
use common\models\documents\GroupDocuments;
use kartik\select2\Select2;

$group = GroupDocuments::find()->all();
$arr_group = \yii\helpers\ArrayHelper::map($group, 'id', 'name_uz');
$user = Yii::$app->user->identity->employ;
$count_lawyer = 0;
$count_moderator = 0;
$count_employ = 0;
$count_boss = 0;
if ($user && $user->role == \common\models\Employ::LAWYER)
    $count_lawyer = \common\models\documents\MainDocument::find()
        ->where(['user_id' => $user->id, 'status' => \common\models\documents\MainDocument::SIGNING])
        ->count();

if ($user && $user->role == \common\models\Employ::MODERATOR)
    $count_moderator = \common\models\documents\MainDocument::find()
        ->where(['user_id' => $user->id, 'status' => \common\models\documents\MainDocument::EDITED])
        ->count();
if ($user && $user->role == \common\models\Employ::EMPLOY)

    $count_employ = \common\models\documents\MainDocument::find()
        ->where(['company_id' => $user->company_id, 'status' => [\common\models\documents\MainDocument::SUCCESS, \common\models\documents\MainDocument::TOBOSS]])
        ->count();
if ($user && $user->company->director)
    $count_boss = \common\models\documents\MainDocument::find()
        ->where(['company_id' => $user->company_id, 'status' => [\common\models\documents\MainDocument::TOBOSS]])
        ->count();

?>

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas position-fixed" id="sidebar">
    <div class="particles-js " id="particles-js"></div>

    <div class="w-100  siderbar_bg"></div>

    <div class="dropdown sidebar-profile-dropdown dropdown_group">
        <!--                        --><? // //
        //                        echo Select2::widget([
        //                            'name' => 'group',
        //                            'id' => 'group',
        //                            'data' => $arr_group,
        //                            'class' => 'aaa',
        //                            'options' => [
        //
        //                                'placeholder' => 'Yangi Xujjat yaratish',
        //                                'allowClear' => true
        //                            ],
        //                        ]);
        //            //            ?>
        <!--            <select aria-label="asd" name="group" id="group" class="dropdown-toggle w-100 select_group">-->
        <!--                <option value="" disabled selected>Yangi xujjat yaratish</option>-->
        <!---->
        <!--                --><? //
        //                foreach ($arr_group as $key => $item) { ?>
        <!--                 -->
        <!--                        <option value="--><? //= $key ?><!--">-->
        <!--                            --><? //= $item ?><!--</option>-->
        <!--                   -->
        <!--                --><? // } ?>
        <!--            </select>-->
        <!--        <a class="dropdown-toggle d-flex align-items-center justify-content-between px-2" href="#"-->
        <!--           data-toggle="dropdown" id="profileDropdown1">-->
        <!--            <i class="mdi mdi-plus-circle menu-icon new_doc_icon mr-2"></i>-->
        <!--            <div>-->
        <!--                <div class="nav-profile-name">Yangi Xujjat yaratish</div>-->
        <!--            </div>-->
        <!--        </a>-->
        <ul class="navbar-nav mr-lg-2">
            <li class="nav-item   text-center ">
                <button type="button"
                        class="btn btn-success btn-icon-text btn_new_doc d-flex align-items-center justify-content-center"
                        data-toggle="dropdown"
                        id="profileDropdown6" aria-expanded="false">
                    <i class="mdi mdi-plus-circle btn-icon-prepend "></i>
                    Yangi xujjat qo'shish
                </button>
                <div class="dropdown-menu dropdown-menu-left navbar-dropdown" aria-labelledby="profileDropdown6">

                    <?
                    foreach ($arr_group as $key => $item) { ?>
                        <a class="dropdown-item text-primary" href="/create?doc=<?= $key ?> ">
                            <i class="mdi mdi-file-document"></i>
                            <?= $item ?>
                        </a>
                    <? } ?>

                </div>
            </li>

        </ul>

        <!--        <div class="dropdown-menu navbar-dropdown dropdown-menu-left" aria-labelledby="profileDropdown1">-->
        <!--            --><? //
        //            foreach ($arr_group as $key => $item) { ?>
        <!--                <a class="dropdown-item" href="/create?doc=--><? //= $key ?><!--">-->
        <!--                    <i class="mdi mdi-file-document"></i>-->
        <!--                    --><? //= $item ?>
        <!--                </a>-->
        <!--            --><? // } ?>
        <!--        </div>-->
    </div>

    <ul class="nav">

        <li class="nav-item">
            <div class="sidebar-title">Menu</div>
            <? if (\frontend\modules\admin\components\Helper::checkRoute('/documents/')) { ?>
                <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false"
                   aria-controls="ui-basic">
                    <i class="mdi mdi-human-child menu-icon"></i>
                    <span class="menu-title">Xodim</span>
                    <div class="badge badge-pill badge-danger"><?= $count_employ ?? '' ?></div>

                    <i class="menu-arrow"></i>

                </a>
                <div class="collapse" id="ui-basic">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/documents">Index</a></li>
                        <li class="nav-item"><a class="nav-link" href="/documents/statistics">Statistics</a></li>


                    </ul>
                </div>
            <? } ?>
        </li>
        <? if (\backend\modules\admin\components\Helper::checkRoute('/lawyer/')) { ?>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false"
                   aria-controls="ui-advanced">
                    <i class="mdi mdi-scale-balance menu-icon"></i>
                    <span class="menu-title">Yurist</span>
                    <div class="badge badge-pill badge-danger"><?= $count_lawyer ?? '' ?></div>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-advanced">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/lawyer/index">Index</a></li>
                    </ul>
                </div>
            </li>
        <? } ?>
        <? if (\backend\modules\admin\components\Helper::checkRoute('/director/')) { ?>

            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ui-boss" aria-expanded="false"
                   aria-controls="ui-boss">
                    <i class="mdi mdi-worker menu-icon"></i>
                    <span class="menu-title">Rahbar</span>
                    <div class="badge badge-pill badge-danger"><?= $count_boss ?? '' ?></div>

                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse" id="ui-boss">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item"><a class="nav-link" href="/director">Index</a></li>
                    </ul>
                </div>
            </li>
        <? } ?>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-news" aria-expanded="false"
               aria-controls="ui-news">
                <i class="mdi mdi-newspaper menu-icon"></i>
                <span class="menu-title">Yangiliklar</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-news">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="/news">Yangiliklar</a></li>
                    <li class="nav-item"><a class="nav-link" href="/law-news">Qonunchilik sohalari</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/templates" aria-expanded="false"
               aria-controls="ui-template">
                <i class="mdi mdi-file-document menu-icon"></i>
                <span class="menu-title">Namunalar</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <?

        ?>
        <? if (\backend\modules\admin\components\Helper::checkRoute('/moderator/')) { ?>
            <li class="nav-item">
                <a class="nav-link" href="/moderator" aria-expanded="false"
                   aria-controls="ui-template">
                    <i class="mdi mdi-settings menu-icon"></i>
                    <span class="menu-title">Moderator</span>
                    <div class="badge badge-pill badge-danger"><?= $count_moderator ?? '' ?></div>
                    <i class="menu-arrow"></i>
                </a>
            </li>
        <? } ?>
        <li class="nav-item">
            <a class="nav-link" href="#ui-about" data-toggle="collapse" aria-expanded="false" aria-controls="ui-about">
                <i class="mdi mdi-human-male-female menu-icon"></i>
                <span class="menu-title">Biz haqimizda</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-about">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="http://biz.yuristlab.uz/">Biz haqimizda</a></li>
                    <li class="nav-item"><a class="nav-link" href="/lawyer/lawyers/">Bizning jamoa</a></li>
                </ul>
            </div>
        </li>

    </ul>
    <div class="designer-info">
        Designed by: <a href="#" target="_blank">Alfa Technologies</a>
    </div>
</nav>
<!-- partial -->