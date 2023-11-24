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
            </h2>
        </div>
        <div class="sub_title_news">
            <?= $content->text_uz ?>
        </div>
    </div>
</div>
