<?php

?>
<div class="container-fluid p-3">
    <div class="row portfolio-grid">
        <?
        foreach ($dataProvider->models as $item) {
            ?>

            <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 col-12">

                    <div class="our-team">
                        <a class="stretched-link" href="/lawyer/info/<?= $item->first_name ?>">
                        </a>
                        <div class="pic">
                            <img src="/frontend/web<?= $item->photo ?>" alt="image"/>
                            <ul class="social">
                                <li><a href="#" class="fab fa-facebook"></a></li>
                                <li><a href="#" class="fab fa-google-plus"></a></li>
                                <li><a href="#" class="fab fa-instagram"></a></li>
                                <li><a href="#" class="fab fa-linkedin"></a></li>
                            </ul>
                        </div>
                        <div class="team-content">
                            <h3 class="title"><?= $item->first_name . ' ' . $item->last_name ?></h3>
                            <span class="post">Web Developer</span>
                        </div>
                    </div>

            </div>
        <? } ?>

    </div>
</div>
