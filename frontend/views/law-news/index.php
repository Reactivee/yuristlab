<?php
/** @var \common\models\documents\ContentNewsSearch $dataProvider */
$models = $dataProvider->models;

?>
<div class="container-fluid px-5">

    <div class="title my-5">
        <h2 class="">Qonunchilik sohalari</h2>
    </div>
    <div class="row">
        <? foreach ($models as $item) { ?>
            <div class="col-md-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                            <img src="<?= $item->icon ? $item->icon : 'https://via.placeholder.com/92x92' ?> "
                                 class="img-lg rounded" alt="profile image">
                            <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                <h6 class="mb-0"><?= $item->title_uz ?></h6>
                                <p class="text-muted mb-1">thomas@gmail.com</p>
                                <a href="/law-news/content?id=<?= $item->id ?>"
                                   class="mb-0 text-success font-weight-bold text-decoration-none">To'liq</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <? } ?>

    </div>
</div>

<div class="row">
</div>