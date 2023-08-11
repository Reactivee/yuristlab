<?php

use common\models\documents\MainDocument;

use kartik\editors\Summernote;
use kartik\file\FileInput;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */

$this->title = $model->name_uz;
$this->params['breadcrumbs'][] = ['label' => 'Main Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$initialPreviewConfigDocs = [];
$initialPreviewConfig = [];
if (!empty($model->attach)) {
    foreach ($model->attach as $item) {

        array_push($initialPreviewConfigDocs, [
            'caption' => $item->path,
            'key' => $item->id,
            'icon' => '<i class="fa fa-arrow-circle-right"></i>',
        ]);
    }
}


//dd($model->signed_lawyer);
?>
    <div class="container-fluid p-3">

        <div class="buttons_wrap mb-3">
            <!--            --><? // if (!$model->signed_lawyer && $model->status != MainDocument::NEW) { ?>
            <!--                --><? //= Html::a(' <i class="fas fa-pencil"></i> Imzolash ', ['/director/to-sign', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>
            <!--                --><? //= Html::a(' <i class="fas fa-backward mr-2"></i> Orqaga ', ['/director/to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ']) ?>
            <!--            --><? // } ?>
            <? if ($model->status != MainDocument::BOSS_SIGNED) { ?>

                <?= Html::a(' <i class="fas fa-backward mr-2"></i> Orqaga ', ['/director/to-resign', 'id' => $model->id], ['class' => 'btn btn-outline-primary btn-danger ']) ?>

                <?= Html::a(' <i class="fas fa-pencil mr-2"></i>Imzolash ', ['/director/to-finish', 'id' => $model->id], ['class' => 'btn btn-outline-success mr-3']) ?>
            <? } ?>

        </div>

        <? if ($model->status == MainDocument::SIGNING) { ?>
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Yuborildi !
            </div>
        <? } ?>

        <? if ($model->status == MainDocument::REJECTED) { ?>
            <div class="alert alert-fill-danger" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Rad etilgan
            </div>
        <? } ?>

        <? if ($model->status == MainDocument::BOSS_SIGNED) { ?>
            <div class="alert alert-fill-success" role="alert">
                <i class="mdi mdi-alert-circle"></i>
                Imzolandi
            </div>
        <? } ?>

        <!--        --><? // echo DetailView::widget([
        //            'model' => $model,
        //            'attributes' => [
        //                'id',
        //                'name_uz',
        //                //        'name_ru',
        //                [
        //                    'attribute' => 'group_id',
        //                    'label' => 'Guruh',
        //                    'value' => function ($model) {
        //                        return $model->group->name_uz;
        //                    }
        //                ],
        ////            [
        ////                'attribute' => 'category_id',
        ////                'label' => 'Kategoriya',
        ////                'value' => function ($model) {
        ////                    return $model->category->name_uz;
        ////                }
        ////            ],
        //
        //                [
        //                    'attribute' => 'sub_category_id',
        //                    'label' => 'Kategoriya',
        //                    'value' => function ($model) {
        //                        return $model->subCategory->name_uz;
        //                    }
        //                ],
        //
        //                [
        //                    'attribute' => 'type_group_id',
        //                    'label' => 'Turkumi',
        //                    'value' => function ($model) {
        //                        return $model->type->name_uz;
        //                    }
        //                ],
        //                [
        //                    'attribute' => 'status',
        //                    'format' => "raw",
        //
        //                    'value' => function ($model) {
        //                        return MainDocument::getStatusNameColored($model->status);
        //                    }
        //                ],
        //                'created_at:datetime',
        //                'updated_at:datetime',
        //                [
        //                    'attribute' => 'created_by',
        //                    'value' => function ($model) {
        //                        return $model->employ->first_name . ' ' . $model->employ->last_name;
        //                    }
        //                ],
        ////            'path',
        //                [
        //                    'attribute' => 'path',
        //                    'format' => "raw",
        //                    'label' => 'Asosiy fayl',
        //                    'value' => '
        //                      <span id="installment-btn"
        //                                          class="showInstallmentModal"
        //                                        data-item=' . $model->id . '
        //                                          data-href=' . Url::to(['/documents/view-template', 'path' => trim($model->path)]) . '>
        //                        <button class="btn btn-success" type="submit">  <i class="fa fa-eye mr-2"></i> Xujjatni korish </button>
        //                        </span>
        //
        //                        <a class="ml-4" href="/frontend/web' . $model->path . '"><i class="fa fa-download"></i> Ko\'chirib olish</a>',
        //
        //                ],
        //                [
        //                    'attribute' => 'files',
        //                    'format' => "raw",
        //                    'label' => 'Qoshimcha',
        //                    'value' => function ($model) use ($initialPreviewConfigDocs) {
        //                        $url = '';
        //                        foreach ($initialPreviewConfigDocs as $item) {
        //                            $url .= Html::a('<img style="width: 120px; height: 100px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
        //                                ['/frontend' . $item['caption']], ['target' => '_blank']);
        //                        }
        //                        return $url;
        //                    }
        //                ],
        //
        //                [
        //                    'attribute' => 'path',
        //                    'format' => "raw",
        //                    'label' => 'Yurist xulosa',
        ////                    'value' => function ($model) {
        ////                        $url = '';
        ////
        ////                        $url .= Html::a('<img style="width: 120px; height: 100px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
        ////                            ['/frontend/web' . $model->lawyer_conclusion_path], ['target' => '_blank']);
        ////
        ////
        ////                        return $url;
        ////                    },
        //                    'value' => function ($model) {
        //                        $html = '
        //                      <span id="installment-btn"
        //                                          class="showInstallmentModal"
        //                                          data-item=' . $model->id . '
        //                                          data-href=' . Url::to(['/documents/view-template', 'path' => trim($model->lawyer_conclusion_path)]) . '>
        //                        <button type="submit"  class="btn btn-success">
        //                        <i class="fa fa-eye mr-2"></i>
        //                        Xujjatni ko\'rish</button>
        //                                               </span>
        //                         <a class="ml-4" href="/frontend/web' . $model->lawyer_conclusion_path . '"><i class="fa fa-download"></i> Ko\'chirib olish</a>';
        //                        if ($model->lawyer_conclusion_path)
        //                            return $html;
        //                    }
        //
        //                ],
        //                [
        //                    'attribute' => 'conclusion_uz',
        //                    'value' => function ($model) {
        //                        return $model->conclusion_uz;
        //                    }
        //                ],
        //
        //            ],
        //        ]);


        ?>
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Xujjat kodi:
                    <span class="text-danger"> <?= $model->code_document ?></span>
                </h4>
                <h4 class="card-title">Xujjat nomi: <span class="lead text-primary font-weight-bolder">
                    <?= $model->name_uz ?>
                </span></h4>

                <hr>
                <div class="row mb-3">

                    <div class="col-md-6">

                        <span class="font-weight-bold card-title">Xujjat bo'limi</span>
                        <p class="text-success font-weight-bold card-title">
                            <?= $model->group->name_uz ?>
                        </p>
                        <? if ($model->category) { ?>
                            <span class="font-weight-bold   card-title">Xujjat turi</span>
                            <p class="text-success font-weight-bold card-title">
                                <?= $model->category->name_uz ?>
                            </p>
                            <span class="font-weight-bold card-title">Yo'nalish</span>
                            <p class="text-success font-weight-bold card-title">
                                <?= $model->subCategory->name_uz; ?>
                            </p>
                            <span class="font-weight-bold card-title ">Turkumi</span>
                            <p class="text-success font-weight-bold card-title">
                                <?= $model->type->name_uz; ?>
                            </p>
                        <? } ?>


                    </div>

                    <div class="col-md-6">
                        <span class="font-weight-bold card-title">Xujjat Yaratilgan sana</span>
                        <p class="text-success font-weight-bold card-title">
                            <?= date('d-m-Y  h:i:s', $model->created_at) ?>
                        </p>
                        <span class="font-weight-bold card-title">Xujjat yaratgan  shaxs</span>
                        <p class="text-warning font-weight-bold card-title">

                            <?= $model->employ->first_name . ' ' . $model->employ->last_name ?>
                        </p>
                        <span class="font-weight-bold card-title">Status</span>
                        <p class="text-primary font-weight-bold card-title">
                            <?= MainDocument::getStatusNameColored($model->status); ?>
                        </p>

                    </div>
                    <div class="col-md-12">
                        <span class="font-weight-bold card-title">Qisqa mazmuni</span>
                        <h3 class="text-primary font-weight-bold">
                            <?= $model->doc_about ?>
                        </h3>
                        <hr>
                        <? if ($model->conclusion_uz) { ?>
                            <span class="font-weight-bold card-title">Yurist xulosa</span>
                            <h5 class="text-primary font-weight-bold">
                                <?= $model->conclusion_uz ?>
                            </h5>
                        <? } ?>
                    </div>

                    <hr>

                    <div class="col-md-6 mt-4">
                        <h5 class="font-weight-bold ">Asosiy fayl</h5>
                        <div class="card">
                            <div class="card-body ">
                                <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                    <? if ($model->path) { ?>
                                        <?= Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                                            ['/documents/doc-template', 'id' => $model->id], ['target' => '_blank']);
                                    } ?>
                                    <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                        <a target="_blank" href="/frontend/web<?= $model->path ?>"
                                           class="mb-0">Ko'chirib olish</a>
                                        <p class="text-muted mb-1">0.5 mb</p>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-4">
                        <? if ($model->lawyer_conclusion_path) { ?>
                            <h5 class="font-weight-bold">Yurist biriktirtan xujjat</h5>
                            <div class="card">
                                <div class="card-body ">
                                    <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                        <?
                                        echo Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                                            ['/frontend/web' . $model->lawyer_conclusion_path], ['target' => '_blank']);
                                        ?>
                                        <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                            <a target="_blank"
                                               href="/frontend/web<?= $model->lawyer_conclusion_path ?>"
                                               class="mb-0">Ko'chirib olish</a>
                                            <p class="text-muted mb-1">
                                                <?
                                                $size = filesize(Yii::getAlias('@frontend') . '/web' . $model->lawyer_conclusion_path);
                                                echo human_filesize($size, 3)
                                                ?>

                                            </p>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        <? } ?>
                    </div>

                    <? if ($files) {
                        foreach ($files as $file) {
                            ?>
                            <div class="col-md-6 mt-4">
                                <h5 class="font-weight-bold ">Qoshimcha faylar</h5>
                                <div class="card">
                                    <div class="card-body ">
                                        <div class="d-sm-flex flex-row flex-wrap text-center text-sm-left align-items-center">
                                            <? if ($model->path) { ?>
                                                <?= Html::a('<img style="width: 90px" src="https://cdn-icons-png.flaticon.com/512/5968/5968517.png" alt="">',
                                                    ['/frontend' . $file->path], ['target' => '_blank']);
                                            } ?>
                                            <div class="ml-sm-3 ml-md-0 ml-xl-3 mt-2 mt-sm-0 mt-md-2 mt-xl-0">
                                                <a target="_blank" href="/frontend<?= $file->path ?>"
                                                   class="mb-0">Ko'chirib olish</a>
                                                <p class="text-muted mb-1">0.5 mb</p>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?
                        }
                    } ?>


                </div>

            </div> <!--end row-->
        </div> <!--end card body-->

    </div>
<?php Modal::begin([
    'title' => '<span class="modal-header-main">Xujjatni ko\'rish </span>',
    'id' => 'modalInstallment',
    'size' => 'modal-dialog modal-lg',
    'headerOptions' => [
        'id' => 'modalInstallmentHeader'
    ],
    'titleOptions' => [
        'class' => 'title-orange-border text-bold text-uppercase',
    ],
    'options' => [
        'class' => 'modalInstallment',
    ],
    'closeButton' => [
        'id' => 'close-button',
        'class' => 'close',
        'data-dismiss' => 'modal',
    ],
    'clientOptions' => [
        //            'backdrop' => 'static',
        'keyboard' => true,
    ],
]); ?>
    <div id='modalInstallmentContent' class="modalContent">
        <div class="loading">
            <div style="text-align:center">
                <?php echo Html::img('@web/public/images/loading.gif'); ?>
            </div>
        </div>
    </div>
<?php Modal::end(); ?>

<?php

$script = <<<JS


$(function(){
    var loading = $('#modalInstallment .loading').html();
    $(document).on('click', '.showInstallmentModal', function(e){
        e.preventDefault();
        $('#modalInstallment').find('#modalInstallmentContent').html(loading);
        console.log($('#modalInstallment').data('amount'));
        console.log($('#modalInstallment').data('bs.modal'));
        if ($('#modalInstallment').data('bs.modal').isShown) {
            $('#modalInstallment').find('#modalInstallmentContent')
                .load($(this).attr('data-href')); 
            $('#installmentTab a').on('click', function (e) {
              e.preventDefault();
              $(this).tab('show');
            })
        } else {
            $('#modalInstallment').modal('show')
                .find('#modalInstallmentContent')
                .load($(this).attr('data-href'));
            $('#installmentTab a').on('click', function (e) {
              e.preventDefault()
              $(this).tab('show')
            })
        }
        return false;
    });

})

JS;
$this->registerJs($script);

?>