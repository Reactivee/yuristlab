<?php

use common\models\Employ;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\EmploySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Employs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employ-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Employ', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'first_name',
            'last_name',
//            'status',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user->username;
                }
            ],
            //'key',
            //'desc:ntext',
            //'type',
            //'phone',
            //'photo',
            [
                'attribute' => 'company_id',
                'value' => function ($model) {
                    return $model->company->name_uz;
                }
            ],

            //'role',
            //'login',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Employ $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
