<?php

?>

<div class="container">
    <div class="">

        <div class="title_news text-center">
            <div class="news_poster mt-4">
                <img src="/frontend/<?= $content->path ?>" alt="">
            </div>
            <div class=" news_poster_title my-4">
                <h1 class="font-weight-bold">  <?= $content->title_uz ?></h1>
                <div class="short_info d-flex align-items-center mt-4">
                    <div class="author mr-3">
                        <i class="mdi mdi-account-outline"></i>
                        <span><?= $content->user->first_name . ' ' . $content->user->first_name ?></span>
                    </div>
                    <div class="news_views mr-3">
                        <i class="mdi mdi-eye"></i>
                        <span><?= $content->views ? $content->views : 0 ?></span>
                    </div>
                    <div class="news_category mr-3">
                        <i class="mdi mdi-file-document-box"></i>
                        <span>Blog</span>
                    </div>
                    <div class="shareit ml-3">
                        <div class="shareon">
                            <a class="facebook"></a>
                            <a class="telegram"></a>
                            <a class="twitter"></a>
                            <a class="vkontakte"></a>
                            <a class="whatsapp"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sub_title_news">
            <?= $content->text_uz ?>
        </div>
    </div>
</div>
