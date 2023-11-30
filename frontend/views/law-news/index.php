<?php
/** @var \common\models\documents\ContentNewsSearch $dataProvider */
$models = $dataProvider->models;

?>
<div class="container-fluid px-5">

    <div class="title mt-3">
        <h1 class="text-center text-black mt-4">Qonunchilik sohalari</h1>
    </div>
    <div class="row mt-5">
        <? foreach ($models as $key => $item) { ?>
            <div class="col-md-4" data-aos="fade-right" data-aos-delay="<?= $key + 1 ?>00">
                <div class="card law-news_card h-100">
                    <a class="text-decoration-none" href="/law-news/content?id="<?= $item->id ?>>
                        <div class="card-body p-3">
                            <div class="d-flex flex-column  text-center text-sm-left align-items-center">
                                <span class="law-news_icon mx-3 text-black">  <?= $item->icon ?></span>
                                <!--                            <img src="-->
                                <? //= $item->icon ? $item->icon : 'https://via.placeholder.com/92x92' ?><!-- "-->
                                <!--                                 class="img-lg rounded" alt="profile image">-->
                                <div class="p-3 mt-4 d-flex flex-column text-black">
                                    <h3 class="mb-3"><?= $item->title_uz ?></h3>
                                    <!--                                <p class="text-muted law_news_sub_title mb-1">-->
                                    <? //= $item->title_uz ?><!--</p>-->

                                    <!--                                <a href="/law-news/content?id=-->
                                    <? //= $item->id ?><!--"-->
                                    <!--                                   class="btn btn-inverse-success btn-fw">To'liq ko'rish</a>-->
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        <? } ?>

    </div>
</div>

<div class="row">
</div>