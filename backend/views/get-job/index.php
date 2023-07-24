<?php

use common\models\GetJob;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\GetJobSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Get Jobs';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="get-job-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Get Job', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'job_id',
                'value' => function ($model) {
                    return $model->job->name_uz;
                }
            ],
//            'user_id',

            [
                'attribute' => 'employ_id',
                'value' => function ($model) {

                    return $model->employ->first_name;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, GetJob $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
