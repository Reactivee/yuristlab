<?php
/** @var \common\models\Employ $models */

use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;

?>
<div class="container-fluid p-4 wrapper_team_profile">

    <div class="row">


        <div class="col-12 ">
            <div class="card-body text-center">
                <div>
                    <img src="https://www.lhh.com/us/en/-/media/lhh_rd/insights-images/licensed-images/08-shutterstock_772074559.jpg?h=333&w=500&hash=83509936180EF9DE39C4FC68020AFA9E"
                         class="mb-3 img-lg rounded" alt="profile image">
                    <h2>Nizomov Doniyor Isomutdin o’g’li</h2>
                    <h5 class="my-2 mr-2 text-muted">Uzbekistan</h5>
                    <p class="mb-0 text-success font-weight-bold">“Yurist Lab” loyihasi asoschisi</p>
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
                        1996-yil 28-noyabrda Jizzax shahrida tug’ilgan</h5>
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
                    <h5 class="p-0 ml-2 mt-1 text-muted">28</h5>
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
                <a href="#" class="btn btn-social-icon-text btn-linkedin mr-3">
                    <i class="mdi mdi-telegram"></i>Telegram
                </a>
                <a href="#" class="btn btn-social-icon-text btn-dribbble mr-3">
                    <i class="mdi mdi-instagram"></i>Instagram
                </a>
                <a href="#" class="btn btn-social-icon-text btn-facebook mr-3"><i
                            class="mdi mdi-facebook"></i>Facebook
                </a>
                <a href="#" class="btn btn-social-icon-text btn-google mr-3"><i class="mdi mdi-google-plus"></i>Google
                </a>
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
                                    <li>
                                        <h6>2020-2020-yillarda “Kvant Group Enterprise”MCHJ</h6>
                                        <p>Yurist</p>
                                        <p class="text-muted mb-4">
                                            <i class="mdi mdi-clock-outline"></i>
                                            3 yil oldin
                                        </p>
                                    </li>
                                    <li>
                                        <h6>2021-H.Q Jizzax shahar Adliya bo’limida </h6>
                                        <p>Bosh yuriskonsult</p>
                                        <p class="text-muted mb-4">
                                            <i class="mdi mdi-clock-outline"></i>
                                            2 yil oldin
                                        </p>
                                    </li>
                                    <li>
                                        <h6>Promotion</h6>
                                        <p>Lorem Ipsum is simply dummy text of the printing </p>
                                        <p class="text-muted">
                                            <i class="mdi mdi-clock-outline"></i>
                                            7 months ago.
                                        </p>
                                    </li>
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
                                    <li>
                                        <h6>Toshkent davlat Yuridik unversiteti </h6>
                                        <p>Bakalavr bitiruvchisi 2017-2021 yillar</p>
                                        <p class="text-muted mb-4">
                                            <i class="mdi mdi-clock-outline"></i>
                                            2 yil oldin
                                        </p>
                                    </li>
                                    <li>
                                        <h6>Toshkent davlat Yuridik unversiteti </h6>
                                        <p>Magistratura bitiruvchisi 2024-2025 yillar</p>
                                        <p class="text-muted mb-4">
                                            <i class="mdi mdi-clock-outline"></i>
                                            <!--                                        2 yil oldin-->
                                        </p>
                                    </li>

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
                                <div class="badge badge-success badge-pill m-3 ">Video montaj</div>
                                <div class="m-2 badge badge-success badge-pill">Adobe After effec</div>
                                <div class="m-2 badge badge-success badge-pill">Adobe Photoshop</div>
                                <div class="m-2 badge badge-success badge-pill">Ingliz tilida erkin muloqot qilish</div>
                                <p class="text-success">
                                    <i class="mdi mdi-alert-octagon mr-2"></i>If the problem persists, you can
                                    contact our
                                    support.
                                </p>
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
                                    <li>
                                        <h6>2022-yilda 3-darajali Yurist</h6>
                                        <p class="text-muted mb-4">
                                            <i class="mdi mdi-clock-outline"></i>
                                            2 yil oldin
                                        </p>
                                    </li>
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

                    <?= Html::submitButton('Save', ['class' => 'btn btn-success mt-2']) ?>

                    <!--                        <button type="submit" class="btn btn-primary mr-2">Saqlash</button>-->
                    <?php ActiveForm::end(); ?>

                </div>
            </div>
            <div class="tab-pane fade" id="editor">
                <div class="card-body">
                    <h4 class="card-title">Horizontal Two column</h4>
                    <form class="form-sample">
                        <p class="card-description">
                            Personal info
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">First Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Last Name</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Gender</label>
                                    <div class="col-sm-9">
                                        <select class="form-control">
                                            <option>Male</option>
                                            <option>Female</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Date of Birth</label>
                                    <div class="col-sm-9">
                                        <input class="form-control" placeholder="dd/mm/yyyy">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Category</label>
                                    <div class="col-sm-9">
                                        <select class="form-control">
                                            <option>Category1</option>
                                            <option>Category2</option>
                                            <option>Category3</option>
                                            <option>Category4</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Membership</label>
                                    <div class="col-sm-4">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                       id="membershipRadios1" value="" checked="">
                                                Free
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="membershipRadios"
                                                       id="membershipRadios2" value="option2">
                                                Professional
                                                <i class="input-helper"></i></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p class="card-description">
                            Address
                        </p>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address 1</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">State</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address 2</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Postcode</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">City</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Country</label>
                                    <div class="col-sm-9">
                                        <select class="form-control">
                                            <option>America</option>
                                            <option>Italy</option>
                                            <option>Russia</option>
                                            <option>Britain</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
