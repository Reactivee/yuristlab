<?php

use common\models\user\AboutEmploy;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\user\AboutEmploySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'About Employs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-employ-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create About Employ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name_uz',
//            'name_ru',
            'icon',
            'img',
            'employ_id',
            //'key',
            //'text:ntext',
            //'status',
            //'begin_date',
            //'end_date',
            //'text_ru',
            //'text_uz',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, AboutEmploy $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
