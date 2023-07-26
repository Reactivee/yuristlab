<?php

use kartik\select2\Select2;
use kartik\tabs\TabsX;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var \common\models\documents\TypeDocumentsSearch $model */

$request = Yii::$app->request;
$id = $request->get('type');

?>

    <div class="welcome-message">
        <div class="d-lg-flex justify-content-between align-items-center">
            <div class="pl-4">
                <h2 class="text-white font-weight-bold mb-3">Shablonlar ro'yhati</h2>
                <p class="pb-0 mb-1">Congratulations! Your account has been setup and you are ready to configure your
                    dashboard now.</p>
                <p>Configuration only take a couple of seconds.</p>
            </div>
            <div class="pl-4">
                <button type="button" class="btn btn-primary">Skip</button>
                <button type="button" class="btn btn-success ml-lg-0 ml-xl-2 ml-2 ml-l mt-lg-2 mt-xl-0">Setup Manually
                </button>
            </div>
        </div>
    </div>

    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class=" container-fluid">
                        <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'options' => [
                                'data-pjax' => 1
                            ],
                        ]); ?>
                        <div class="row">


                            <div class="col-md-4">
                                <?
                                echo $form->field($model, 'group_doc')->widget(Select2::classname(), [
                                    'data' => \common\models\documents\MainDocument::subAllGroup(),
                                    'theme' => Select2::THEME_MATERIAL,
                                    'options' => [
                                        'placeholder' => 'Select provinces ...',
                                        'multiple' => true,
                                        'allowClear' => true
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?
                                echo $form->field($model, 'category')->widget(Select2::classname(), [
                                    'data' => \common\models\documents\MainDocument::getAllCategory(),
                                    'theme' => Select2::THEME_MATERIAL,
                                    'options' => [
                                        'placeholder' => 'Select provinces ...',
                                        'multiple' => true,
                                        'allowClear' => true
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]);
                                ?>
                            </div>
                            <div class="col-md-4">
                                <?
                                echo $form->field($model, 'sub_category')->widget(Select2::classname(), [
                                    'data' => \common\models\documents\MainDocument::subAllGetCategory(),
                                    'theme' => Select2::THEME_MATERIAL,
                                    'options' => [
                                        'placeholder' => 'Select provinces ...',
                                        'multiple' => true,
                                        'allowClear' => true
                                    ],
                                    'pluginOptions' => [
                                        'allowClear' => true,
                                    ],
                                ]);
                                ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?= Html::submitButton('Ko\'rsatish', ['class' => 'btn btn-success']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

                        <!--      -->
                        <!--                        <ul class="nav nav-pills nav-pills-info" id="types-tab" role="tablist">-->
                        <!---->
                        <!--                            <li class="nav-item">-->
                        <!--                                <a class="nav-link -->
                        <?//= $id == null ? "active" : "" ?><!-- " id="types-"-->
                        <!--                                   href="/templates"-->
                        <!--                                   role="tab" aria-controls="types_"-->
                        <!--                                   aria-selected="true">Hammasi</a>-->
                        <!--                            </li>-->
                        <!--                            --><?// foreach ($types as $key => $type) { ?>
                        <!--                                <li class="nav-item">-->
                        <!--                                    <a class="nav-link -->
                        <?//= $type->id == $id ? 'active' : '' ?><!--"-->
                        <!--                                       id="types---><?//= $type->id ?><!--"-->
                        <!--                                       href="?type=--><?//= $type->id ?><!--"-->
                        <!--                                       role="tab" aria-controls="types_-->
                        <?//= $type->id ?><!--"-->
                        <!--                                       aria-selected="true">-->
                        <?//= $type->name_uz ?><!--</a>-->
                        <!--                                </li>-->
                        <!--                            --><?// } ?>
                        <!--                        </ul>-->

                        <?php Pjax::begin(); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],
                                [
                                    'attribute' => 'category_id',
                                    'value'=>function($model){
                                    return $model->category->name_uz;
                                    }
                                ],
                                'name_uz',
                                'name_ru',


                            ],
                        ]) ?>
                        <?php Pjax::end(); ?>

                    </div>


                </div>

            </div>

        </div>
    </div>
<?php
