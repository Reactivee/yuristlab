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
                <div class="card h-100">
                    <div class="card-body p-3">
                        <div class="d-flex flex-row  text-center text-sm-left align-items-center">
                          <span class="law-news_icon mx-3">  <?= $item->icon ?></span>
                            <!--                            <img src="-->
                            <? //= $item->icon ? $item->icon : 'https://via.placeholder.com/92x92' ?><!-- "-->
                            <!--                                 class="img-lg rounded" alt="profile image">-->
                            <div class="p-3 d-flex flex-column">
                                <h3 class="mb-3"><?= $item->title_uz ?></h3>
                                <!--                                <p class="text-muted law_news_sub_title mb-1">-->
                                <? //= $item->title_uz ?><!--</p>-->
                                <a href="/law-news/content?id=<?= $item->id ?>"
                                   class="mb-0 text-success font-weight-bold text-decoration-none ">To'liq ko'rish</a>
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