<?php

use common\models\news\LawContent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\news\LawContentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Law Contents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="law-content-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Law Content', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <!--    --><?php //Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'law_id',
                'label' => 'Xujjat bolimi',

                'value' => function ($model) {
                    return $model->law->title_uz;
                }
            ],
            'title_uz',
            'text_uz',
            'status',
            [
                'attribute' => 'image',
                'label' => 'Xujjat',
                'format' => 'html',
                'value' => function ($model) {
                    $url = '';
                    if ($model->image) {
                        $url = Html::a("Ko'chirib olish", $model->image);

                    }
                    return $url;
                }
            ],

            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, LawContent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <!--    --><?php //Pjax::end(); ?>

</div>
