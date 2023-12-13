<?php

?>
<div class="container-fluid p-3">
    <div class="row">
        <?
        foreach ($dataProvider->models as $item) {
            ?>
            <div data-aos="fade-up" class="col-md-11 ml-auto mr-auto mb-4">
                <div class="team_card overflow-hidden">
                    <div class="team_card card-body ">
                        <div class="d-flex align-items-center w-100 ">
                            <img data-aos-duration="1500" data-aos="fade-right" src="/frontend/web<?= $item->photo ?>"
                                 style="width: 280px" alt="profile image">
                            <div data-aos-duration="1500" data-aos="fade-left"
                                 class="ml-3 d-flex flex-column justify-content-start h-100">
                                <h2 class="h2 mb-0 text-black font-weight-bold mb-3"><?= $item->first_name . ' ' . $item->last_name ?></h2>
                                <p class="text-muted mb-2"><?= $item->desc ?></p>

                                <p class="mb-0 text-success font-weight-bold">Yurist</p>
                                <div class="sign mt-3">
                                    <img  style="width: 150px; height: 80px" src="<?= $item->sign ?>" alt="">
                                </div>

                                <div>
                                    <a href="/lawyer/info/<?= $item->first_name ?>"
                                       class="mt-4 d-inline-block btn btn-inverse-secondary  align-items-center w-auto btn-fw">
                                        To'liq korish <i class="fa fa-angle-double-right ml-2"></i></a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <!--            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">-->
            <!---->
            <!--                    <div class="our-team">-->
            <!--                        <a class="stretched-link" href="/lawyer/info/--><? //= $item->first_name ?><!--">-->
            <!--                        </a>-->
            <!--                        <div class="pic">-->
            <!--                            <img src="/frontend/web--><? //= $item->photo ?><!--" alt="image"/>-->
            <!--                        </div>-->
            <!--                        <div class="team-content">-->
            <!--                            <h3 class="title">--><? //= $item->first_name . ' ' . $item->last_name ?><!--</h3>-->
            <!--                            <span class="post">Yurist</span>-->
            <!--                        </div>-->
            <!--                    </div>-->
            <!---->
            <!--            </div>-->
        <? } ?>

    </div>
</div>
