<?php

use common\models\documents\GroupDocuments;
use kartik\select2\Select2;

$group = GroupDocuments::find()->all();
$arr_group = \yii\helpers\ArrayHelper::map($group, 'id', 'name_uz');

?>

<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">


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
        <a class="dropdown-toggle d-flex align-items-center justify-content-between px-2" href="#"
           data-toggle="dropdown" id="profileDropdown1">
            <img src="https://via.placeholder.com/36x36" alt="profile" class="sidebar-profile-icon">
            <div>
                <div class="nav-profile-name">Yangi Xujjat yaratish</div>
            </div>
        </a>

        <div class="dropdown-menu navbar-dropdown dropdown-menu-left" aria-labelledby="profileDropdown1">
            <?
            foreach ($arr_group as $key => $item) { ?>
                <a class="dropdown-item" href="/create?doc=<?= $key ?>">
                    <i class="mdi mdi-file-document"></i>
                    <?= $item ?>
                </a>
            <? } ?>
        </div>
    </div>

    <ul class="nav">

        <li class="nav-item">
            <div class="sidebar-title">Menu</div>
            <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <i class="mdi mdi-heart-outline menu-icon"></i>
                <span class="menu-title">Xodim</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="/documents">Docs</a></li>
                    <li class="nav-item"><a class="nav-link" href="/documents/statistics">Stat</a></li>



                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-advanced" aria-expanded="false"
               aria-controls="ui-advanced">
                <i class="mdi mdi-folder-outline menu-icon"></i>
                <span class="menu-title">Lawer</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-advanced">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="/lawyer">Index</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-boss" aria-expanded="false"
               aria-controls="ui-boss">
                <i class="mdi mdi-folder-outline menu-icon"></i>
                <span class="menu-title">Rahbar</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-boss">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="/director">Index</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#ui-news" aria-expanded="false"
               aria-controls="ui-news">
                <i class="mdi mdi-folder-outline menu-icon"></i>
                <span class="menu-title">Yangiliklar</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-news">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="/news">News</a></li>
                    <li class="nav-item"><a class="nav-link" href="/law-news">Law News</a></li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="/templates" aria-expanded="false"
               aria-controls="ui-template">
                <i class="mdi mdi-folder-outline menu-icon"></i>
                <span class="menu-title">Namunalar</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="/moderator" aria-expanded="false"
               aria-controls="ui-template">
                <i class="mdi mdi-folder-outline menu-icon"></i>
                <span class="menu-title">Moderator</span>
                <i class="menu-arrow"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link"  href="/lawyer/lawyers" aria-expanded="false"
               aria-controls="ui-template">
                <i class="mdi mdi-folder-outline menu-icon"></i>
                <span class="menu-title">Team</span>
                <i class="menu-arrow"></i>
            </a>
        </li>



    </ul>
    <div class="designer-info">
        Designed by: <a href="#" target="_blank">Alfa Technologies</a>
    </div>
</nav>
<!-- partial -->