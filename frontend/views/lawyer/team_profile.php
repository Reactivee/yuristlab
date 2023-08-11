<?php
/** @var \common\models\Employ $models */

?>
<div class="container-fluid p-3 wrapper_team_profile">

    <div class="row">
        <div class="col-md-4 ">
            <div class="border-bottom text-center p-4 bg-white">
                <img src="/frontend/web<?= $models->photo ?>" alt="profile" class="img-round rounded-circle mb-3">
                <div class="mb-3">
                    <h3><?= $models->first_name . ' ' . $models->last_name ?></h3>
                    <div class="d-flex align-items-center justify-content-center">
                        <h5 class="mb-0 mr-2 text-muted">Uzbekistan</h5>

                    </div>
                </div>
                <p class="w-75 mx-auto mb-3"><?= $models->desc ?></p>
                <div class="d-flex justify-content-center">
                    <button class="btn btn-success mr-1">Message</button>
                    <button class="btn btn-success">Follow</button>
                </div>
                <div class="border-top mt-3 pt-3">
                    <div class="row">
                        <div class="col-4">
                            <h3 class="text-success">5896</h3>
                            <p class="text-success font-weight-bold ">Imzolagan</p>
                        </div>
                        <div class="col-4">
                            <h3 class="text-danger font-weight-bold">1596</h3>
                            <p class="text-danger font-weight-bold">Rad etgan</p>
                        </div>
                        <div class="col-4 text-warning">
                            <h3 class="text-warning font-weight-bold">7896</h3>
                            <p class="font-weight-bold">Likes</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class=" text-center my-4 bg-white">
                <div class="team_info">


                    <p class="clearfix">
                          <span class="float-left">
                            <i class="mdi mdi-email"></i>
                            Mail
                          </span>
                        <span class="float-right text-muted">
                            Jacod@testmail.com
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                              <i class="mdi mdi-facebook"></i>
                            Facebook
                          </span>
                        <span class="float-right text-muted">
                            <a href="#">David Grey</a>
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                              <i class="mdi mdi-twitter"></i>
                            Twitter
                          </span>
                        <span class="float-right text-muted">
                            <a href="#">@davidgrey</a>
                          </span>
                    </p>
                    <p class="clearfix mb-0">
                          <span class="float-left">
                              <i class="mdi mdi-telegram"></i>
                            Telegram
                          </span>
                        <span class="float-right text-muted">
                            <a href="#">@davidgrey</a>
                          </span>
                    </p>
                    <p class="clearfix mb-0">
                          <span class="float-left">
                              <i class="mdi mdi-instagram"></i>
                            Instagram
                          </span>
                        <span class="float-right text-muted">
                            <a href="#">@davidgrey</a>
                          </span>
                    </p>
                </div>
            </div>


        </div>
        <div class="col-md-8">
            <div class=" text-center bg-white">
                <div class="team_info">
                    <p class="clearfix">
                          <span class="float-left">
                            Full name
                          </span>
                        <span class="float-right text-muted">
                            <?= $models->first_name . ' ' . $models->last_name ?>
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                            Phone
                          </span>
                        <span class="float-right text-muted">
                            006 3435 22
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                            Address
                          </span>
                        <span class="float-right text-muted">
                            Jacod@testmail.com
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                            Email
                          </span>
                        <span class="float-right text-muted">
                            <a href="#">David Grey</a>
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                            Ish joyi
                          </span>
                        <span class="float-right text-muted">
                            <a href="#">David Grey</a>
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                         Lavozimi
                          </span>
                        <span class="float-right text-muted">
                            <a href="#">David Grey</a>
                          </span>
                    </p>
                    <p class="clearfix">
                          <span class="float-left">
                            Status
                          </span>
                        <span class="float-right  badge badge-success badge-pill text-white">
                            Active
                          </span>
                    </p>

                </div>
            </div>


        </div>
    </div>
</div>
