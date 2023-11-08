<?php
/** @var \common\models\documents\ContentNewsSearch $dataProvider */
$models = $dataProvider->models;

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-sm-flex justify-content-between align-items-center border-bottom">
                <div class="d-flex align-items-center">
                    <ul class="nav nav-tabs home-tab" role="tablist">
                        <? foreach ($category as $key => $item) { ?>
                            <li class="nav-item">
                                <a class="nav-link <?= $key == 0 ? 'active' : '' ?> "
                                   id="pills-<?= $item->id ?>-tab-custom"
                                   data-toggle="pill"
                                   href="#pills-<?= $item->id ?>"
                                   role="tab"
                                   aria-controls="pills-<?= $item->id ?>" aria-selected="true">
                                    <?= $item->name_uz ?>
                                </a>
                            </li>
                        <? } ?>
                    </ul>

                </div>


            </div>
            <!--            <ul class="nav nav-pills nav-pills-custom" id="pills-tab-custom" role="tablist">-->
            <!--                --><? // foreach ($category as $key => $item) { ?>
            <!--                    <li class="nav-item">-->
            <!--                        <a class="nav-link --><? //= $key == 0 ? 'active' : '' ?><!-- " id="pills--->
            <? //= $item->id ?><!---tab-custom"-->
            <!--                           data-toggle="pill"-->
            <!--                           href="#pills---><? //= $item->id ?><!--"-->
            <!--                           role="tab"-->
            <!--                           aria-controls="pills---><? //= $item->id ?><!--" aria-selected="true">-->
            <!--                            --><? //= $item->name_uz ?>
            <!--                        </a>-->
            <!--                    </li>-->
            <!--                --><? // } ?>
            <!---->
            <!--            </ul>-->

            <div class="tab-content tab-content-custom-pill overflow-hidden" id="pills-tabContent-custom">

                <? foreach ($category as $key => $item) { ?>

                    <div class=" row mt-4 fade <?= $key == 0 ? "show active" : '' ?>"
                         id="pills-<?= $item->id ?>"
                         role="tabpanel"
                         aria-labelledby="pills-home-tab-custom">
                        <?php foreach ($models as $key => $news) {
                            if ($news->category_id == $item->id) { ?>

                                <div class="col-md-3 mb-4" data-aos="fade-left" data-aos-delay="<?= $key + 1 ?>00">
                                    <div class="card news_card h-100">
                                        <div class="card_news_img_wrapper">
                                            <img class="card-img-top card-img_main"
                                                 src="<?= $news->path ? '/frontend/' . $news->path : ' https://via.placeholder.com/248x248' ?> "
                                                 alt="<?= $news->title_uz ?>">
                                        </div>
                                        <div class="card-body_news">
                                            <span class="btn card_category  btn-inverse-secondary btn-fw"><?= $news->categoryname->name_uz ?></span>
                                            <h4 class="card_title mt-3"><?= $news->title_uz ?></h4>
                                            <span><? $news->created_at ?></span>
                                            <p class="card-text_news">
                                                <?= $news->sub_title_uz ?>
                                            </p>
                                            <a class="mt-4 btn btn-inverse-secondary d-inline-flex align-items-center"
                                               href="news/content/<?= $news->id ?>">
                                                To'liq ko'rish
                                                <i class="fa fa-angle-double-right ml-2"></i>
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
