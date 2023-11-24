<?php
?>

<div class="container">
    <div class="">

        <div class="title_news text-center">
            <div class="news_poster mt-4">
                <img src="/frontend/<?= $content->path ?>" alt="">
            </div>
            <h2 class="text-black news_poster_title my-4">
                <?= $content->title_uz ?>
                <div class="short_info d-flex align-items-center mt-3">
                    <div class="author mr-3">
                        <i class="mdi mdi-account-outline"></i>
                        <span>Name</span>
                    </div>
                    <div class="news_views mr-3">
                        <i class="mdi mdi-eye"></i>
                        <span>1000</span>
                    </div>
                    <div class="news_category mr-3">
                        <i class="mdi mdi-file-document-box"></i>
                        <span>Blog</span>
                    </div>
                    <div class="shareit"    ></div>
                </div>
            </h2>
        </div>
        <div class="sub_title_news">
            <?= $content->text_uz ?>
        </div>
    </div>
</div>
