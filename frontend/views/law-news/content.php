<?php

?>

<div class="container">
    <h1 class="text-black text-center my-4"><?= $content[0]->law->title_uz ?> </h1>
    <? foreach ($content as $item) { ?>
        <div class="sub_title_news mt-4 mb-3 d-flex justify-content-between align-items-center">
            <div class="title_news col-9">
                <h3 class=" my-2">
                    <?= $item->title_uz ?>
                </h3>
                <hr>
                <h4><i>  <?= $item->text_uz ?></i></h4>
            </div>
            <div class="col-3 text-right">
                <a href="<?= $item->image ?>" type="button" class="btn  btn-warning btn-icon-text">
                    <i class="mdi mdi-download btn-icon-prepend"></i>
                    Ko'chirib olish
                </a>
            </div>
        </div>
    <? } ?>
</div>
