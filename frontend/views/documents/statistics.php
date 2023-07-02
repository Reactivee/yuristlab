<?php
//dd($model);
use common\models\documents\MainDocument;

$status = \common\models\documents\MainDocument::getStatusNameArr();
?>

<div class="container-fluid pt-3 px-5">

    <div class="row">
        <? foreach ($status as $key => $item) { ?>
            <div class="col-md-3 mb-3">
                <div class="card ">
                    <div class="card-body <?= MainDocument::getStatusNameColor($key) ?> ">
                        <h4 class="card-title text-default text-center"><?= $item ?></h4>
                        <div class="d-flex justify-content-center">
                            <!--                            <p class="text-muted">Avg. Session</p>-->
                            <h1 class="text-center"><?= MainDocument::getByStatusDocuments($key) ?></h1>
                        </div>
                        <!--                        <div class="progress progress-md">-->
                        <!--                            <div class="progress-bar bg-danger w-25" role="progressbar" aria-valuenow="25"-->
                        <!--                                 aria-valuemin="0"-->
                        <!--                                 aria-valuemax="100"></div>-->
                        <!--                        </div>-->
                    </div>
                </div>
            </div>
        <? } ?>

    </div>
</div>
