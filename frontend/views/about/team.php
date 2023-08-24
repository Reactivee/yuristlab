<?php

?>
<div class="container-fluid p-3">
    <h1 class="text-success text-center text-uppercase my-4">Bizning jamoa </h1>
    <div class="row portfolio-grid">
        <?
        foreach ($dataProvider->models as $item) {
            ?>

            <div class="col-xl-6 col-lg-3 col-md-3 col-sm-6 col-12">
                <a class="text-decoration-none" href="/lawyer/info/<?= $item->first_name ?>">
                    <div class="our-team d-flex  align-items-center">
                        <img class="team_bg w-100 overflow-hidden" src="/images/contact-top-right-v3.png" alt="">

                        <div class="pic">
                            <img src="/frontend/web<?= $item->photo ?>" alt="image"/>
                        </div>
                        <div class="team-content">
                            <h3 class="title"><?= $item->first_name . ' ' . $item->last_name ?></h3>
                            <span class="post"><?= $item->desc ?></span>
                            <button class="btn btn-success mt-4 w-50">To'liqroq </button>
                        </div>
                    </div>

                </a>
            </div>
            <div class="col-xl-6 col-lg-3 col-md-3 col-sm-6 col-12">
                <a class="text-decoration-none" href="/lawyer/info/<?= $item->first_name ?>">
                    <div class="our-team d-flex  align-items-center">
                        <img class="team_bg w-100 overflow-hidden" src="/images/contact-top-right-v3.png" alt="">

                        <div class="pic">
                            <img src="/frontend/web<?= $item->photo ?>" alt="image"/>
                        </div>
                        <div class="team-content">
                            <h3 class="title"><?= $item->first_name . ' ' . $item->last_name ?></h3>
                            <span class="post"><?= $item->desc ?></span>
                            <button class="btn btn-success mt-4 w-50">To'liqroq </button>

                        </div>
                    </div>

                </a>
            </div>
        <? } ?>

    </div>
</div>
