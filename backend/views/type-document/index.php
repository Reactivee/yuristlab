<?php

use common\models\documents\TypeDocuments;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var common\models\documents\TypeDocumentsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Type Documents';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-documents-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Type Documents', ['create'], ['class' => 'btn btn-success']) ?>
    </p>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name_uz',
            [
                'attribute' => 'category_id',
                'value' => function ($model) {
                    return $model->category->name_uz;
                }
            ],
            'status',
            //'created_at',
            //'updated_at',
            [
                'attribute' => 'path',
                'format' => 'html',
                'value' => function ($model) {
                    if ($model->path)
                        return Html::a('Fayl', '/frontend/web/' . $model->path, ['target' => '_blank']);
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, TypeDocuments $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]); ?>

    <!--    --><?php //Pjax::end(); ?>

</div>
