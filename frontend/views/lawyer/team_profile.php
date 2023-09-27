<?php
/** @var \common\models\Employ $models */

use common\models\user\AboutEmploy;
use kartik\date\DatePicker;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="container-fluid p-4 wrapper_team_profile">

    <div class="row">


        <div class="col-12 ">
            <div class="card-body text-center">
                <div>
                    <img src="<?= $models->photo ?>"
                         class="mb-3 img-lg rounded" alt="profile image">
                    <h2><?= $models->first_name . ' ' . $models->last_name ?>  </h2>
                    <h5 class="my-2 mr-2 text-muted"><?= $models->company->name_uz ?></h5>
                    <p class="mb-0 mt-2 text-success font-weight-bold"><?= $models->desc ?> </p>
                </div>
            </div>
            <hr>
        </div>

        <div class="col-12 d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center mr-4">
                <i class="mdi  mdi-map-marker icon-md"></i>
                <h4 class="card-title mt-2 mr-2"> Manzili:</h4>
                <div class="d-flex align-items-center">
                    <h5 class="text-muted p-0 mt-1">
                        <?= $models->address ?></h5>
                </div>
            </div>

            <div class="d-flex align-items-center mr-4">
                <i class="mdi mdi mdi-account icon-md"></i>
                <h4 class=" mr-1 card-title mt-2">Lavozim:</h4>
                <div class="d-flex align-items-center">
                    <h5 class=" p-0 mt-1 text-muted">Yurist</h5>
                </div>
            </div>

            <div class="d-flex align-items-center">
                <i class="mdi mdi-av-timer icon-md "></i>
                <h4 class="card-title mt-2">Yosh:</h4>
                <div class="d-flex mt-0 align-items-center">
                    <h5 class="p-0 ml-2 mt-1 text-muted"><?= $models->age ?></h5>
                </div>
            </div>
            <div class="d-flex align-items-center">
                <i class="mdi mdi-account icon-md"></i>
                <h4 class="card-title mt-2">Xolati:</h4>
                <div class="d-flex mt-0 align-items-center">
                    <div class=" ml-2 badge badge-success badge-pill">Faol</div>
                </div>
            </div>

        </div>
        <div class="col-12">
            <hr>
            <div class="d-flex">
                <a href="<?= $models->telegram ?>" class="btn btn-social-icon-text btn-linkedin mr-3">
                    <i class="mdi mdi-telegram"></i>Telegram
                </a>
                <a href="<?= $models->instagram ?>" class="btn btn-social-icon-text btn-dribbble mr-3">
                    <i class="mdi mdi-instagram"></i>Instagram
                </a>
                <a href="<?= $models->facebook ?>" class="btn btn-social-icon-text btn-facebook mr-3"><i
                            class="mdi mdi-facebook"></i>Facebook
                </a>
                <a href="<?= $models->other ?>" class="btn btn-social-icon-text btn-google mr-3 ">
                    <i class="mdi mdi-google-plus"></i>Google
                </a>
            </div>
            <hr>
        </div>

        <div class="col-md-12 tab-content ">
            <div class="tab-pane fade active show" id="home-2">
                <div class="accordion" id="accordion" role="tablist">

                    <div class="card">
                        <div class="card-header show active" role="tab" id="heading-1">
                            <h6 class="mb-0">
                                <a data-toggle="collapse" href="#collapse-1" aria-expanded="false"
                                   aria-controls="collapse-1" class="collapsed">
                                    <i class="mdi mdi mdi-briefcase icon-md mr-2"></i>
                                    Ish Tajribasi
                                </a>
                            </h6>
                        </div>
                        <div id="collapse-1" class="collapse show" role="tabpanel" aria-labelledby="heading-1"
                             data-parent="#accordion" style="">
                            <div class="card-body">
                                <!--                            <h4 class="card-title">Updates</h4>-->
                                <ul class="bullet-line-list">
                                    <? $info = AboutEmploy::getInfo(AboutEmploy::WORK_PLACE, $models->id) ?>
                                    <? foreach ($info as $item) { ?>
                                        <li>
                                            <h6><?= $item->name_uz ?></h6>
                                            <p><?= $item->text_uz ?></p>
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
                                    <? $info = AboutEmploy::getInfo(AboutEmploy::EDU, $models->id) ?>

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

                    <!--                    <div class="card">-->
                    <!--                        <div class="card-header" role="tab" id="heading-3">-->
                    <!--                            <h6 class="mb-0">-->
                    <!--                                <a class="collapsed" data-toggle="collapse" href="#collapse-3" aria-expanded="false"-->
                    <!--                                   aria-controls="collapse-3">-->
                    <!--                                    <i class="mdi mdi-facebook-box mr-2"></i>-->
                    <!--                                    Kontaktlar-->
                    <!--                                </a>-->
                    <!--                            </h6>-->
                    <!--                        </div>-->
                    <!--                        <div id="collapse-3" class="collapse" role="tabpanel" aria-labelledby="heading-3"-->
                    <!--                             data-parent="#accordion">-->
                    <!--                            <div class="card-body">-->
                    <!--                                <a href="#" class="btn btn-social-icon-text btn-facebook">-->
                    <!--                                    <i class="mdi mdi-telegram"></i>Telegram-->
                    <!--                                </a>-->
                    <!--                                <a href="#" class="btn btn-social-icon-text btn-google">-->
                    <!--                                    <i class="mdi mdi-instagram"></i>Instagram-->
                    <!--                                </a>-->
                    <!--                                <a href="#" class="btn btn-social-icon-text btn-facebook"><i-->
                    <!--                                            class="mdi mdi-facebook"></i>Facebook-->
                    <!--                                </a>-->
                    <!--                            </div>-->
                    <!--                        </div>-->
                    <!--                    </div>-->

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
                                    <? $info = AboutEmploy::getInfo(AboutEmploy::WORK_EXP,$models->id) ?>

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

                </div>
            </div>

            <div class="tab-pane fade" id="profile-2">
                <div class="card-body">
                    <?php $form = ActiveForm::begin(); ?>

                    <!--                    <form id="form" class="forms-sample" action="/lawyer/userdata" method="post">-->
                    <!--                    <div class="form-group">-->
                    <!--                        <label for="exampleInputUsername1">Login</label>-->
                    <!--                        <input type="text" name="login" class="form-control" id="exampleInputUsername1"-->
                    <!--                               placeholder="Username">-->
                    <!--                    </div>-->
                    <!--                    --><? // dd($models->user); ?>
                    <?= $form->field($user_form, 'login')->textInput(['maxlength' => true, 'value' => $models->user->username])->label('Login') ?>
                    <?= $form->field($user_form, 'email')->textInput(['maxlength' => true, 'value' => $models->user->email])->label('Email manzil') ?>
                    <?= $form->field($user_form, 'old_pass')->passwordInput(['maxlength' => true])->label('Eski parol') ?>
                    <?= $form->field($user_form, 'new_pass')->passwordInput(['maxlength' => true])->label('Yangi parol') ?>
                    <?= $form->field($user_form, 'new_pass_confirm')->passwordInput(['maxlength' => true])->label('Parolni tasdiqlash') ?>

                    <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success mt-2']) ?>

                    <!--                        <button type="submit" class="btn btn-primary mr-2">Saqlash</button>-->
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <div class="tab-pane fade" id="editor">
                <div class="card-body">
                    <!--                    <form class="form-sample">-->
                    <!---->
                    <!--                        <div class="row">-->
                    <!--                            <h4 class="card-title">Xodim ish joylari</h4>-->
                    <!---->
                    <!--                            <div class="col-md-12 work-form">-->
                    <!--                                <div class="form-group row">-->
                    <!--                                    <label class="col-sm-2 col-form-label card-title">Ish joyi</label>-->
                    <!--                                    <div class="col-sm-10">-->
                    <!--                                        <input type="text" class="form-control">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                                <div class="form-group row">-->
                    <!--                                    <label class="col-sm-2 col-form-label card-title">Lavozimi</label>-->
                    <!--                                    <div class="col-sm-10">-->
                    <!--                                        <input type="text" class="form-control">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!---->
                    <!--                                <div class="form-group ">-->
                    <!--                                    <h4 class="card-title">Ishlagan davr</h4>-->
                    <!--                                    <div class="input-group input-daterange d-flex align-items-center">-->
                    <!--                                        <input type="text" class="form-control" value="2022-04-05">-->
                    <!--                                        <div class="input-group-addon mx-4">gacha</div>-->
                    <!--                                        <input type="text" class="form-control" value="2023-04-19">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                                <button type="button" class="btn btn-warning text-right">+</button>-->
                    <!--                                <hr>-->
                    <!---->
                    <!--                            </div>-->
                    <!---->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <h4 class="card-title">Ta'lim davri</h4>-->
                    <!---->
                    <!--                            <div class="col-md-12 work-form">-->
                    <!--                                <div class="form-group row">-->
                    <!--                                    <label class="col-sm-2 col-form-label card-title">O'quv muassasasi</label>-->
                    <!--                                    <div class="col-sm-10">-->
                    <!--                                        <input type="text" class="form-control">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                                <div class="form-group row">-->
                    <!--                                    <label class="col-sm-2 col-form-label card-title">Lavozimi</label>-->
                    <!--                                    <div class="col-sm-10">-->
                    <!--                                        <input type="text" class="form-control">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!---->
                    <!--                                <div class="form-group ">-->
                    <!--                                    <h4 class="card-title">O'quv davr</h4>-->
                    <!--                                    <div class="input-group input-daterange d-flex align-items-center">-->
                    <!--                                        <input type="text" class="form-control" value="2022-04-05">-->
                    <!--                                        <div class="input-group-addon mx-4">gacha</div>-->
                    <!--                                        <input type="text" class="form-control" value="2023-04-19">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!--                                <button type="button" class="btn btn-warning text-right">+</button>-->
                    <!--                                <hr>-->
                    <!---->
                    <!--                            </div>-->
                    <!---->
                    <!--                        </div>-->
                    <!--                        <div class="row">-->
                    <!--                            <h4 class="card-title">Xobbilar</h4>-->
                    <!---->
                    <!--                            <div class="col-md-12 work-form">-->
                    <!--                                <div class="form-group row">-->
                    <!--                                    <label class="col-sm-2 col-form-label card-title">O'quv muassasasi</label>-->
                    <!--                                    <div class="col-sm-10">-->
                    <!--                                        <input type="text" class="form-control">-->
                    <!--                                    </div>-->
                    <!--                                </div>-->
                    <!---->
                    <!--                                <button type="button" class="btn btn-warning text-right">+</button>-->
                    <!--                                <hr>-->
                    <!---->
                    <!--                            </div>-->
                    <!---->
                    <!--                        </div>-->
                    <!---->
                    <!--                        --><? //= Html::button('Saqlash', ['class' => 'btn btn-success mt-2']) ?>
                    <!--                    </form>-->
                    <div class="col-md-12">
                        <?php $dynform = ActiveForm::begin(['id' => 'dynamic-form',
                            'action' => '/lawyer/about-employ']); ?>
                        <?php DynamicFormWidget::begin(['widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                            'widgetBody' => '.container-items', // required: css class selector
                            'widgetItem' => '.item', // required: css class
                            'limit' => 50, // the maximum times, an element can be cloned (default 999)
                            'min' => 0, // 0 or 1 (default 1)
                            'insertButton' => '.add-item', // css class
                            'deleteButton' => '.remove-item', // css class
                            'model' => $about[0],
                            'formId' => 'dynamic-form',
                            'formFields' => ['name_uz',
                                'name_ru',
                                'text_ru',
                                'text_uz',
                                'begin_date',
                                'end_date',],]); ?>
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
                                                    echo Html::activeHiddenInput($item, "[{
                                            $i
                                            }]id");
                                                }

                                                ?>

                                                <div class="row mt-3">
                                                    <div class="col-sm-12">
                                                        <?= $dynform->field($item, "[{
                                                    $i
                                                    }]key")
                                                            ->dropdownList($item->getKeys())
                                                            ->label('Yo\'nalish') ?>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <?= $dynform->field($item, "[{
                                                    $i
                                                    }]name_uz")
                                                            ->textInput(['maxlength' => true, ['inputOptions' => ['autocomplete' => 'off']]])
                                                            ->label('Ishlagan joy') ?>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <?= $dynform->field($item, "[{
                                                    $i
                                                    }]text_uz")
                                                            ->textInput(['maxlength' => true, ['inputOptions' => ['autocomplete' => 'off']]])
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
                        <div class="col-sm-12 m-0 p-0">
                            <?= $dynform->field($item, "text")
                                ->textInput(['maxlength' => true, ['inputOptions' => ['autocomplete' => 'off']]])
                                ->label('Hobbilar') ?>
                        </div>
                        <div class="form-group">
                            <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
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
        jQuery(this).html("Ta'lim olgan:" + (index + 1))
    });
});


jQuery(".dynamicform_wrapper").on("afterInsert", function(e, item) {
  
    jQuery(".dynamicform_wrapper .panel-title-edu").each(function(index) {
        jQuery(this).html("Ta'lim olgan:" + (index + 1))
    });
    var inputs = item.getElementsByTagName("input");
        for(var i = 0; i < inputs.length; i++) {
    
    inputs[i].removeAttribute("value");
    inputs[i].setAttribute("value","");
     }
});

jQuery(".dynamicform_wrapper").on("afterDelete", function(e) {
    jQuery(".dynamicform_wrapper .panel-title-edu").each(function(index) {
        jQuery(this).html("Ta'lim olgan:" + (index + 1))
    });
});
JS;

$this->registerJs($js2, 3);
?>
