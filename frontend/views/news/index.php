<?php
/** @var \common\models\documents\ContentNewsSearch $dataProvider */
$models = $dataProvider->models;

?>
<div class="container-fluid px-4 mt-4">
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills nav-pills-custom" id="pills-tab-custom" role="tablist">
                <? foreach ($category as $key => $item) { ?>
                    <li class="nav-item">
                        <a class="nav-link <?= $key == 0 ? 'active' : '' ?> " id="pills-<?= $item->id ?>-tab-custom"
                           data-toggle="pill"
                           href="#pills-<?= $item->id ?>"
                           role="tab"
                           aria-controls="pills-<?= $item->id ?>" aria-selected="true">
                            <?= $item->name_uz ?>
                        </a>
                    </li>
                <? } ?>

            </ul>

            <div class="tab-content tab-content-custom-pill" id="pills-tabContent-custom">

                <? foreach ($category as $key => $item) { ?>

                    <div class="tab-pane fade <?= $key == 0 ? "show active" : '' ?>" id="pills-<?= $item->id ?>"
                         role="tabpanel"
                         aria-labelledby="pills-home-tab-custom">
                        <?php foreach ($models as $news) {
                            if ($news->category_id == $item->id) { ?>
                                <div class="col-md-4">
                                    <div class="card">
                                        <img class="card-img-top" src="https://via.placeholder.com/363x363"
                                             alt="<?= $news->title_uz ?>">
                                        <div class="card-body">
                                            <h4 class="card-title mt-3"><?= $news->title_uz ?></h4>
                                            <span> 10.10.2023</span>
                                            <p class="card-text">
                                                <?= $news->text_uz ?>
                                            </p>
                                            <a class=" w-100  py-3 text-decoration-none btn btn-inverse-secondary btn-fw  stretched-link"
                                               href="#">
                                                To'liq
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        } ?>
                    </div>
                <? } ?>

            </div>
        </div>


    </div>
</div>

<div class="row">
</div>