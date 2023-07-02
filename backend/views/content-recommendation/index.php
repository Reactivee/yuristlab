<?php

use common\models\documents\ContentRecommendation;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var common\models\documents\ContentRecommendationSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Content Recommendations';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-recommendation-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Content Recommendation', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'title_uz',
            'title_ru',
            'text_uz:ntext',
            'text_ru:ntext',
            //'status',
            //'path:ntext',
            //'created_at',
            //'updated_at',
            //'created_by',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, ContentRecommendation $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
