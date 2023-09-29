<?php
/** @var \common\models\Employ $models */

use common\models\user\AboutEmploy;
use kartik\date\DatePicker;
use kartik\editable\Editable;
use kartik\file\FileInput;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

//dd($models);

?>
<style>
    .social_wrapper .kv-editable-value {
        display: none;
    }
</style>
<div class="container-fluid p-4 wrapper_team_profile">

    <div class="row">
        <div class="col-12 ">
            <div class="card-body text-center">
                <div>
                    <img src="<?= $models->photo ?>"
                         class="mb-3 img-lg rounded" alt="profile image">
                    <h2><?= $models->first_name . ' ' . $models->last_name ?>  </h2>
                    <h5 class="my-2 mr-2 text-muted"><?= $models->company->name_uz ?></h5>
                    <p class="mb-0 text-success font-weight-bold">
                        <?
                        echo Editable::widget([
                            'name' => 'desc',
                            'asPopover' => true,
                            'displayValue' => $models->desc,
                            'format' => Editable::FORMAT_BUTTON,
                            'editableValueOptions' => ['class' => 'text-success font-weight-bold'],
                            'inputType' => Editable::INPUT_TEXTAREA,
                            'value' => $models->desc,
                            'header' => 'Xodim haqida',
                            'size' => 'lg',
                            'submitOnEnter' => false,
                            'editableButtonOptions' => [
                                'label' => '<i class="fas fa-edit"></i>',
                            ],
                            'submitButton' => [
                                'icon' => '<i class="fas fa-check"></i>',
                                'class' => 'btn btn-success',
                                'label' => 'btn btn-success',
                            ],
                            'options' => [
                                'class' => 'form-control',
                                'rows' => 3,
                                'placeholder' => '',
                            ],
                        ]);
                        ?>
                    </p>

                </div>
            </div>
            <hr>
        </div>

        <div class="col-12 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center mr-4">
                <i class="mdi  mdi-map-marker icon-md"></i>
                <h4 class="card-title mt-2 mr-2"> Manzili:</h4>
                <div class="d-flex align-items-center">
                    <!--                    <h5 class="text-muted p-0 mt-1">--><? //= $models->address ?><!--</h5>-->
                    <h5 class="text-primary font-weight-bold">
                        <?
                        echo Editable::widget([
                            'name' => 'address',
                            'asPopover' => true,
                            'displayValue' => $models->address,
                            'format' => Editable::FORMAT_BUTTON,
                            'editableValueOptions' => ['class' => 'text-muted'],
                            'inputType' => Editable::INPUT_TEXTAREA,
                            'value' => $models->address,
                            'header' => 'Yurist xulosa',
                            'size' => 'lg',
                            'submitOnEnter' => false,
                            'editableButtonOptions' => [
                                'label' => '<i class="fas fa-edit"></i>',
                            ],
                            'submitButton' => [
                                'icon' => '<i class="fas fa-check"></i>',
                                'class' => 'btn btn-success',
                                'label' => 'btn btn-success',
                            ],
                            'options' => [
                                'class' => 'form-control',
                                'rows' => 3,
                                'placeholder' => '',
                            ],
                        ]);
                        ?>
                        <!--                            --><? //= $model->conclusion_uz ?>
                    </h5>
                </div>
            </div>

            <div class="d-flex align-items-center mr-4">
                <i class="mdi mdi mdi-account icon-md"></i>
                <h4 class=" mr-1 card-title mt-2">Lavozim:</h4>
                <div class="d-flex align-items-center">
                    <h5 class=" p-0 mt-1 text-muted"> <?= \common\models\Employ::getRole(Yii::$app->user->identity->employ->role); ?></h5>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <i class="mdi mdi-av-timer icon-md "></i>
                <h4 class="card-title mt-2">Yosh:</h4>
                <div class="d-flex mt-0 align-items-center">
                    <h5 class="p-0 ml-2 mt-1 text-muted">
                        <?
                        echo Editable::widget([
                            'name' => 'age',
                            'asPopover' => true,
                            'displayValue' => $models->age,
                            'format' => Editable::FORMAT_BUTTON,
                            'editableValueOptions' => ['class' => 'text-muted'],
                            'inputType' => Editable::INPUT_TEXTAREA,
                            'value' => $models->age,
                            'header' => 'Yoshi',
                            'size' => 'lg',
                            'submitOnEnter' => false,
                            'editableButtonOptions' => [
                                'label' => '<i class="fas fa-edit"></i>',
                            ],
                            'submitButton' => [
                                'icon' => '<i class="fas fa-check"></i>',
                                'class' => 'btn btn-success',
                                'label' => 'btn btn-success',
                            ],
                            'options' => [
                                'class' => 'form-control',
                                'rows' => 3,
                                'placeholder' => '',
                            ],
                        ]);
                        ?>
                    </h5>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <i class="mdi mdi-account icon-md"></i>
                <h4 class="card-title mt-2">Xolati:</h4>
                <div class="d-flex mt-0 align-items-center">
                    <div class=" ml-2 mb-1 badge badge-success badge-pill">
                        <?= $models->getStatus($models->status) ?>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-12">
            <hr>
            <div class="d-flex align-items-center social_wrapper">
                <div class="mr-3">
                    <a href="<?= $models->telegram ?>" class="btn btn-social-icon-text btn-linkedin">
                        <i class="mdi mdi-telegram"></i>Telegram
                    </a>
                    <? echo Editable::widget([
                        'name' => 'telegram',
                        'asPopover' => true,
                        'format' => Editable::FORMAT_BUTTON,
                        'editableValueOptions' => ['class' => 'text-muted p-0 m-0'],
                        'inputType' => Editable::INPUT_TEXTAREA,
                        'value' => $models->telegram,
                        'header' => 'Social',
                        'size' => 'lg',
                        'submitOnEnter' => false,
                        'editableButtonOptions' => [
                            'label' => '<i class="fas fa-edit"></i>',
                            'class' => 'btn btn-sm btn-default p-0',
                        ],
                        'submitButton' => [
                            'icon' => '<i class="fas fa-check"></i>',
                            'class' => 'btn btn-success',
                            'label' => 'btn btn-success',
                        ],
                        'options' => [
                            'class' => 'form-control p-0 mr-3',
                            'rows' => 3,
                            'placeholder' => '',
                        ],
                    ]);
                    ?>
                </div>
                <div class="mr-3">
                    <a href="<?= $models->instagram ?>" class="btn btn-social-icon-text btn-dribbble">
                        <i class="mdi mdi-instagram"></i>Instagram
                    </a>
                    <? echo Editable::widget([
                        'name' => 'instagram',
                        'asPopover' => true,
                        'format' => Editable::FORMAT_BUTTON,
                        'editableValueOptions' => ['class' => 'text-muted p-0 m-0'],
                        'inputType' => Editable::INPUT_TEXTAREA,
                        'value' => $models->instagram,
                        'header' => 'Social',
                        'size' => 'lg',
                        'submitOnEnter' => false,
                        'editableButtonOptions' => [
                            'label' => '<i class="fas fa-edit"></i>',
                            'class' => 'btn btn-sm btn-default p-0',
                        ],
                        'submitButton' => [
                            'icon' => '<i class="fas fa-check"></i>',
                            'class' => 'btn btn-success',
                            'label' => 'btn btn-success',
                        ],
                        'options' => [
                            'class' => 'form-control p-0 m-0',
                            'rows' => 3,
                            'placeholder' => '',
                        ],
                    ]);
                    ?>
                </div>
                <div class="mr-3">
                    <a href="<?= $models->facebook ?>" class="btn btn-social-icon-text btn-facebook"><i
                                class="mdi mdi-facebook"></i>Facebook
                    </a>
                    <? echo Editable::widget([
                        'name' => 'facebook',
                        'asPopover' => true,
                        'format' => Editable::FORMAT_BUTTON,
                        'editableValueOptions' => ['class' => 'text-muted p-0 m-0'],
                        'inputType' => Editable::INPUT_TEXTAREA,
                        'value' => $models->facebook,
                        'header' => 'Social',
                        'size' => 'lg',
                        'submitOnEnter' => false,
                        'editableButtonOptions' => [
                            'label' => '<i class="fas fa-edit"></i>',
                            'class' => 'btn btn-sm btn-default p-0',
                        ],
                        'submitButton' => [
                            'icon' => '<i class="fas fa-check"></i>',
                            'class' => 'btn btn-success',
                            'label' => 'btn btn-success',
                        ],
                        'options' => [
                            'class' => 'form-control p-0 m-0',
                            'rows' => 3,
                            'placeholder' => '',
                        ],
                    ]);
                    ?>
                </div>
                <div class="mr-3">
                    <a href="<?= $models->other ?>" class="btn btn-social-icon-text btn-google">
                        <i class="mdi mdi-google-plus"></i>Google
                    </a>
                    <? echo Editable::widget([
                        'name' => 'other',
                        'asPopover' => true,
                        'format' => Editable::FORMAT_BUTTON,
                        'editableValueOptions' => ['class' => 'text-muted p-0 m-0'],
                        'inputType' => Editable::INPUT_TEXTAREA,
                        'value' => $models->other,
                        'header' => 'Social',
                        'size' => 'lg',
                        'submitOnEnter' => false,
                        'editableButtonOptions' => [
                            'label' => '<i class="fas fa-edit"></i>',
                            'class' => 'btn btn-sm btn-default p-0',
                        ],
                        'submitButton' => [
                            'icon' => '<i class="fas fa-check"></i>',
                            'class' => 'btn btn-success',
                            'label' => 'btn btn-success',
                        ],
                        'options' => [
                            'class' => 'form-control p-0 m-0',
                            'rows' => 3,
                            'placeholder' => '',
                        ],
                    ]);
                    ?>
                </div>
            </div>
            <hr>
        </div>


        <div class="col-md-3 ">
            <ul class="nav nav-tabs nav-tabs-vertical user_tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="home-tab-vertical" data-toggle="tab" href="#home-2" role="tab"
                       aria-controls="home-2" aria-selected="true">
                        Xodim haqida
                        <i class="mdi mdi-home-outline text-warning text-info ml-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab-vertical" data-toggle="tab" href="#profile-2" role="tab"
                       aria-controls="profile-2" aria-selected="false">
                        Xavfsizlik
                        <i class="mdi  mdi-security text-danger ml-2"></i>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="editor-tab-vertical" data-toggle="tab" href="#editor" role="tab"
                       aria-controls="contact-2" aria-selected="false">
                        Ma'lumotlar o'zgaritish
                        <i class="mdi mdi-table-edit text-success ml-2"></i>
                    </a>
                </li>
            </ul>
            <div class=" mb-3">
                <canvas id="signature-pad" class="signature-pad" width=350 height=200></canvas>

            </div>
            <button class="btn btn-success mb-3" id="save-png">Save as PNG</button>
            <button class="btn btn-danger mb-3" id="clear">Clear</button>
        </div>

        <div class="col-md-9 tab-content ">



            <div class="tab-pane fade active show" id="home-2">
                <div class="accordion" id="accordion" role="tablist">

                    <div class="card">
                        <div class="card-header" role="tab" id="heading-1">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-1" aria-expanded="false"
                                   aria-controls="collapse-1" class="collapsed">
                                    <i class="mdi mdi mdi-briefcase icon-md mr-2"></i>
                                    Ish Tajribasi
                                </a>
                            </h6>
                        </div>
                        <div id="collapse-1" class="collapse" role="tabpanel" aria-labelledby="heading-1"
                             data-parent="#accordion" style="">
                            <div class="card-body">
                                <!--                            <h4 class="card-title">Updates</h4>-->
                                <ul class="bullet-line-list">
                                    <? $info = AboutEmploy::getInfo(AboutEmploy::WORK_PLACE) ?>
                                    <? foreach ($info as $item) { ?>
                                        <li>
                                            <h6><?= $item->name_uz ?></h6>
                                            <p><?= $item->text_uz ?></p>

                                            <!--                                            <p class="text-muted mb-4">-->
                                            <!--                                                <i class="mdi mdi-clock-outline"></i>-->
                                            <!--                                                3 yil oldin-->
                                            <!--                                            </p>-->

                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header" role="tab" id="heading-2">
                            <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-2" aria-expanded="false"
                                   aria-controls="collapse-2">
                                    <i class="mdi mdi-school mr-2"></i>
                                    Ta'lim
                                </a>
                            </h6>
                        </div>
                        <div id="collapse-2" class="collapse" role="tabpanel" aria-labelledby="heading-2"
                             data-parent="#accordion">
                            <div class="card-body">
                                <!--                            <h4 class="card-title">Updates</h4>-->
                                <ul class="bullet-line-list">
                                    <? $info = AboutEmploy::getInfo(AboutEmploy::EDU) ?>

                                    <? foreach ($info as $item) { ?>
                                        <li>
                                            <h6><?= $item->name_uz ?></h6>
                                            <p><?= $item->text_uz ?></p>
                                            <!--                                            <p class="text-muted mb-4">-->
                                            <!--                                                <i class="mdi mdi-clock-outline"></i>-->
                                            <!--                                                3 yil oldin-->
                                            <!--                                            </p>-->
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header" role="tab" id="heading-5">
                            <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-5" aria-expanded="false"
                                   aria-controls="collapse-5">
                                    <i class="mdi mdi-rocket icon-md mr-2"></i>
                                    Martaba darajasi:
                                </a>
                            </h6>
                        </div>
                        <div id="collapse-5" class="collapse" role="tabpanel" aria-labelledby="heading-5"
                             data-parent="#accordion">
                            <div class="card-body">
                                <ul class="bullet-line-list">
                                    <? $info = AboutEmploy::getInfo(AboutEmploy::WORK_EXP) ?>

                                    <? foreach ($info as $item) { ?>
                                        <li>
                                            <h6><?= $item->name_uz ?></h6>
                                            <p><?= $item->text_uz ?></p>
                                            <!--                                            <p class="text-muted mb-4">-->
                                            <!--                                                <i class="mdi mdi-clock-outline"></i>-->
                                            <!--                                                3 yil oldin-->
                                            <!--                                            </p>-->
                                        </li>
                                    <? } ?>
                                </ul>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-header" role="tab" id="heading-4">
                            <h6 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" href="#collapse-4" aria-expanded="false"
                                   aria-controls="collapse-4">
                                    <i class="mdi mdi-gamepad-variant mr-2"></i>
                                    Mavjud ko’nikmalari (Qiziqishlar,hobbylari)
                                </a>
                            </h6>
                        </div>
                        <div id="collapse-4" class="collapse" role="tabpanel" aria-labelledby="heading-4"
                             data-parent="#accordion">
                            <div class="card-body">
                                <?
                                $parts = preg_split('/\s+/', $models->hobby);
                                if ($parts) {
                                    foreach ($parts as $word) {
                                        ?>
                                        <h2 class="badge badge-success badge-pill mr-2"><?= $word ?></h2>
                                        <?
                                    }
                                }
                                ?>


                            </div>
                        </div>
                    </div>


                </div>
            </div>

            <div class="tab-pane fade" id="profile-2">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <?= $form->field($user_form, 'login')->textInput(['maxlength' => true, 'value' => $models->user->username])->label('Login') ?>
                    <?= $form->field($user_form, 'email')->textInput(['maxlength' => true, 'value' => $models->user->email])->label('Email manzil') ?>
                    <?= $form->field($user_form, 'old_pass')->passwordInput(['maxlength' => true])->label('Eski parol') ?>
                    <?= $form->field($user_form, 'new_pass')->passwordInput(['maxlength' => true])->label('Yangi parol') ?>
                    <?= $form->field($user_form, 'new_pass_confirm')->passwordInput(['maxlength' => true])->label('Parolni tasdiqlash') ?>

                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success mt-2']) ?>
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <div class="tab-pane fade" id="editor">
                <div class="card-body row">
                    <div class="col-md-12">
                        <?php $dynform = ActiveForm::begin([
                            'id' => 'dynamic-form',
                            'action' => '/user/about-employ'
                        ]); ?>
                        <?php DynamicFormWidget::begin([
                            'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 50, // the maximum times, an element can be cloned (default 999)
                            'min' => 0, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $about[0],
                            'formId' => 'dynamic-form',
                            'formFields' => [
                                'name_uz',
                                'name_ru',
                                'text_ru',
                                'text_uz',
                                'begin_date',
                                'end_date',
                            ],
                        ]); ?>
                        <!--Working place -->
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <button type="button" class="pull-right add-item btn btn-success">
                                    <i class="fa fa-plus mr-2"></i>Faoliyat davri qo'shish
                                </button>
                                <div class="clearfix"></div>
                            </div>
                            <div class="panel-body">
                                <div class="container-items"><!-- widgetContainer -->
                                    <?php foreach ($about as $i => $item) { ?>
                                        <div class="item panel panel-default mt-2"><!-- widgetBody -->
                                            <div class="panel-heading">
                                                <span class="panel-title-working">Faoliyat davr: <?= ($i + 1) ?></span>
                                                <div class="pull-right">
                                                    <button type="button" class="remove-item btn btn-danger btn-xs">
                                                        <i class="fa fa-minus"></i></button>
                                                </div>
                                                <div class="clearfix"></div>
                                            </div>

                                            <div class="panel-body">
                                                <?php if (!$item->isNewRecord) {
                                                    echo Html::activeHiddenInput($item, "[{$i}]id");
                                                }

                                                ?>

                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <?= $dynform->field($item, "[{$i}]key")
                                                            ->dropdownList($item->getKeys())
                                                            ->label('Yo\'nalish') ?>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <?= $dynform->field($item, "[{$i}]name_uz")
                                                            ->textInput(['maxlength' => true, ['inputOptions' => [
                                                                'autocomplete' => 'off']]])
                                                            ->label('Faoliyat joy') ?>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <?= $dynform->field($item, "[{$i}]text_uz")
                                                            ->textInput(['maxlength' => true, ['inputOptions' => [
                                                                'autocomplete' => 'off']]])
                                                            ->label('Lavozim') ?>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>
                        <?php DynamicFormWidget::end(); ?>
                        <hr>
                    </div>

                    <div class="col-12 ">
                        <?= $dynform->field($models, "hobby")
                            ->textInput(['maxlength' => true, ['inputOptions' => [
                                'autocomplete' => 'off']]])
                            ->label('Hobbilar') ?>
                    </div>
                    <div class="col-6">
                        <?= $dynform->field($models, "passport")
                            ->textInput(['maxlength' => true, ['inputOptions' => [
                                'autocomplete' => 'off']]])
                            ->label('Pasport seriya') ?>
                    </div>
                    <div class="col-6">
                        <?= $dynform->field($models, "inn")
                            ->textInput(['maxlength' => true, ['inputOptions' => [
                                'autocomplete' => 'off']]])
                            ->label('INN') ?>
                    </div>
                    <hr>
                    <div class="col-6">
                        <?= $dynform->field($models, 'photo')->widget(FileInput::classname(), [
                            'options' => ['accept' => 'image/*'],
                            'pluginOptions' => [
                                'initialPreviewAsData' => true,
                                'allowedFileExtensions' => ["jpg", "png"],
                                'previewFileType' => 'image',
                                'elCaptionText' => '#customCaption',
                                'showCancel' => false,
                                'showCaption' => false,
                                'showUpload' => false,
                                'maxFileSize' => 1000,
                                'browseLabel' => 'Fayl yuklash',
                            ]
                        ])->label('Rasm yuklash');
                        ?>
                    </div>


                    <div class="form-group col-12">
                        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>


        </div>


    </div>


    <div class="row">
        <!--        <div class="col-md-4 ">-->
        <!--            <div class="border-bottom text-center p-4 bg-white">-->
        <!--                <img src="/frontend/web-->
        <? //= $models->photo ?><!--" alt="profile" class="img-round rounded-circle mb-3">-->
        <!--                <div class="mb-3">-->
        <!--                    <h3>--><? //= $models->first_name . ' ' . $models->last_name ?><!--</h3>-->
        <!--                    <div class="d-flex align-items-center justify-content-center">-->
        <!--                        <h5 class="mb-0 mr-2 text-muted">Uzbekistan</h5>-->
        <!---->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <p class="w-75 mx-auto mb-3">--><? //= $models->desc ?><!--</p>-->
        <!--                <div class="d-flex justify-content-center">-->
        <!--                    <button class="btn btn-success mr-1">Message</button>-->
        <!--                    <button class="btn btn-success">Follow</button>-->
        <!--                </div>-->
        <!--                <div class="border-top mt-3 pt-3">-->
        <!--                    <div class="row">-->
        <!--                        <div class="col-4">-->
        <!--                            <h3 class="text-success">5896</h3>-->
        <!--                            <p class="text-success font-weight-bold ">Imzolagan</p>-->
        <!--                        </div>-->
        <!--                        <div class="col-4">-->
        <!--                            <h3 class="text-danger font-weight-bold">1596</h3>-->
        <!--                            <p class="text-danger font-weight-bold">Rad etgan</p>-->
        <!--                        </div>-->
        <!--                        <div class="col-4 text-warning">-->
        <!--                            <h3 class="text-warning font-weight-bold">7896</h3>-->
        <!--                            <p class="font-weight-bold">Likes</p>-->
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!--            <div class=" text-center my-4 bg-white">-->
        <!--                <div class="team_info">-->
        <!---->
        <!---->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                            <i class="mdi mdi-email"></i>-->
        <!--                            Mail-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            Jacod@testmail.com-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                              <i class="mdi mdi-facebook"></i>-->
        <!--                            Facebook-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            <a href="#">David Grey</a>-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                              <i class="mdi mdi-twitter"></i>-->
        <!--                            Twitter-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            <a href="#">@davidgrey</a>-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix mb-0">-->
        <!--                          <span class="float-left">-->
        <!--                              <i class="mdi mdi-telegram"></i>-->
        <!--                            Telegram-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            <a href="#">@davidgrey</a>-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix mb-0">-->
        <!--                          <span class="float-left">-->
        <!--                              <i class="mdi mdi-instagram"></i>-->
        <!--                            Instagram-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            <a href="#">@davidgrey</a>-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!---->
        <!--        </div>-->
        <!--        <div class="col-md-8">-->
        <!--            <div class=" text-center bg-white">-->
        <!--                <div class="team_info">-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                            Full name-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            --><? //= $models->first_name . ' ' . $models->last_name ?>
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                            Phone-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            006 3435 22-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                            Address-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            Jacod@testmail.com-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                            Email-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            <a href="#">David Grey</a>-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                            Ish joyi-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            <a href="#">David Grey</a>-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                         Lavozimi-->
        <!--                          </span>-->
        <!--                        <span class="float-right text-muted">-->
        <!--                            <a href="#">David Grey</a>-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!--                    <p class="clearfix">-->
        <!--                          <span class="float-left">-->
        <!--                            Status-->
        <!--                          </span>-->
        <!--                        <span class="float-right  badge badge-success badge-pill text-white">-->
        <!--                            Active-->
        <!--                          </span>-->
        <!--                    </p>-->
        <!---->
        <!--                </div>-->
        <!--            </div>-->
        <!---->
        <!---->
        <!--        </div>-->
    </div>
</div>

<?php

$js2 = <<<JS
jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {

    jQuery(".dynamicform_wrapper .panel-title-working").each(function(index) {
        jQuery(this).html("Faoliyat davr:" + (index + 1))
    });
    var inputs = item.getElementsByTagName("input");
        for(var i = 0; i < inputs.length; i++) {
    
    inputs[i].removeAttribute("value");
    inputs[i].setAttribute("value","");
     }
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-working").each(function(index) {
        jQuery(this).html("Faoliyat davr:" + (index + 1))
    });
});

JS;

$this->registerJs($js2, 3);
?>
