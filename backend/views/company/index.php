<?php

use common\models\Company;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\CompanySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Companies';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Company', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!--    --><?php //Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name_uz',
            'name_ru',
            [
                'attribute' => 'director',
                'value' => function ($model) {
                    return $model->employ->first_name;

                }
            ],
//            'key',
            'address',

            [
                'attribute' => 'logo',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::img($model->logo, ['width' => 100]);
                }
            ],
            [
                'attribute' => 'template_doc',
                'format' => 'html',
                'value' => function ($model) {
                    return Html::a('File', $model->template_doc);
                }
            ],

            //'desc:ntext',
            //'status',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Company $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <!--    --><?php //Pjax::end(); ?>

</div>
