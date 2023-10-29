<?

use common\models\documents\MainDocument;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var \common\models\documents\MainDocument $model */


?>
<div class="card-body">

    <h4 class="card-title">Xujjat kodi:
        <span class="text-danger"> <?= $model->code_document ?></span>
    </h4>
    <h4 class="card-title">Xujjat nomi: <span class="lead text-primary font-weight-bolder">
                    <?= $model->name_uz ?>  </span>
    </h4>

    <hr>
    <div class="row">
        <div class="col-md-6">
            <span class="font-weight-bold card-title">Xujjat bo'limi</span>
            <p class="text-success font-weight-bold card-title">
                <?= $model->group->name_uz ?>
            </p>
        </div>

        <? if ($model->category) { ?>
            <div class="col-md-6">
                <span class="font-weight-bold   card-title">Xujjat turi</span>
                <p class="text-success font-weight-bold card-title">
                    <?= $model->category->name_uz ?>
                </p>
            </div>

        <? } ?>

        <? if ($model->category) { ?>
            <div class="col-md-6">
                <span class="font-weight-bold card-title">Yo'nalish</span>
                <p class="text-success font-weight-bold card-title">
                    <?= $model->subCategory->name_uz; ?>
                </p>
            </div>
        <? } ?>

        <? if ($model->category) { ?>
            <div class="col-md-6">

                <span class="font-weight-bold card-title ">Turkumi</span>
                <p class="text-success font-weight-bold card-title">
                    <?= $model->type->name_uz; ?>
                </p>
            </div>

        <? } ?>


        <div class="col-md-6">
            <span class="font-weight-bold card-title">Xujjat Yaratilgan sana</span>
            <p class="text-success font-weight-bold card-title">
                <?= date('d-m-Y  h:i:s', $model->created_at) ?>
            </p>
        </div>
        <div class="col-md-6">
            <span class="font-weight-bold card-title">Xujjat yaratgan  shaxs</span>
            <p class="text-warning font-weight-bold card-title">

                <?= $model->employ->first_name . ' ' . $model->employ->last_name ?>
            </p>
        </div>
        <div class="col-md-6">
            <span class="font-weight-bold card-title">Status</span>
            <p class="text-primary font-weight-bold card-title">
                <?= MainDocument::getStatusNameColored($model->status); ?>
            </p>
            <? if ($model->step == MainDocument::STEP_BOSS_FINISH) { ?>
                <span class="text-danger font-weight-bold">Jarayon yakunlangan !</span>
            <? } ?>

        </div>

        <? if ($model->status == MainDocument::REJECTED) { ?>
            <div class="col-md-6">

                <span class="font-weight-bold card-title">Yurist xulosasi</span>
                <br>
                <p class="text-white badge badge-danger badge-pill font-weight-bold card-title "><?= $model->conclusion_uz ?></p>
            </div>

        <? } ?>

        <div class="col-md-12">
            <span class="font-weight-bold card-title">Qisqa mazmuni</span>
            <h4 class="text-success font-weight-bold">
                <?= $model->doc_about ?>
            </h4>
            <hr>
        </div>

        <div class="col-md-4 mt-4">
            <h5 class="font-weight-bold card-title">Asosiy xujjat</h5>
            <div class="card">
                <div class="card-body ">
                    <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">

                        <?= Html::a('<img style="width: 90px" src="/images/main-file.png" alt="">',
                            ['doc-template', 'id' => $model->id], ['target' => '_blank']); ?>
                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                            <a target="_blank" href="/frontend/web<?= $model->path ?>"
                               class="mb-0 text-warning font-weight-bold ">
                                <i class="fa fa-cloud-download mr-1"></i>
                                Ko'chirib olish</a>
                            <p class="text-muted mb-1">
                                <?
                                if (file_exists(Yii::getAlias('@frontend') . '/web' . $model->path)) {
                                    $size = filesize(Yii::getAlias('@frontend') . '/web' . $model->path);
                                    echo human_filesize($size, 3);
                                } ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!--end row-->

</div>

