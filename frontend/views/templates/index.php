<?php

use kartik\tabs\TabsX;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

$request = Yii::$app->request;
$id = $request->get('type');

?>

    <div class="welcome-message">
        <div class="d-lg-flex justify-content-between align-items-center">
            <div class="pl-4">
                <h2 class="text-white font-weight-bold mb-3">Shablonlar ro'yhati</h2>
                <p class="pb-0 mb-1">Congratulations! Your account has been setup and you are ready to configure your
                    dashboard now.</p>
                <p>Configuration only take a couple of seconds.</p>
            </div>
            <div class="pl-4">
                <button type="button" class="btn btn-primary">Skip</button>
                <button type="button" class="btn btn-success ml-lg-0 ml-xl-2 ml-2 ml-l mt-lg-2 mt-xl-0">Setup Manually
                </button>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="coll">
                                <h4 class="card-title">Types</h4>
                                <p class="card-description">Basic nav pills</p>
                            </div>
                            <div class="coll">
                                <div class="dropdown">
                                    <button class="btn btn-danger dropdown-toggle" type="button"
                                            id="dropdownMenuSizeButton2" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        Groups
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuSizeButton2"
                                         x-placement="bottom-start"
                                         style="position: absolute; transform: translate3d(0px, 30px, 0px); top: 0px; left: 0px; will-change: transform;">
                                        <h6 class="dropdown-header">Settings</h6>
                                        <a class="dropdown-item" href="#">Action</a>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <ul class="nav nav-pills nav-pills-info" id="types-tab" role="tablist">

                            <li class="nav-item">
                                <a class="nav-link <?= $id == null ? "active" : "" ?> " id="types-"
                                   href="/templates"
                                   role="tab" aria-controls="types_"
                                   aria-selected="true">Hammasi</a>
                            </li>
                            <? foreach ($types as $key => $type) { ?>
                                <li class="nav-item">
                                    <a class="nav-link <?= $type->id == $id ? 'active' : '' ?>"
                                       id="types-<?= $type->id ?>"
                                       href="?type=<?= $type->id ?>"
                                       role="tab" aria-controls="types_<?= $type->id ?>"
                                       aria-selected="true"><?= $type->name_uz ?></a>
                                </li>
                            <? } ?>
                        </ul>

                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                'name_uz',
                                'name_ru',
                                'group_id',
                                'parent_id',

                            ],
                        ]) ?>
                        <?php Pjax::end(); ?>
                    </div>


                </div>

            </div>

        </div>
    </div>
<?php
