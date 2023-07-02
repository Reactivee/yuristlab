<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\CategoryNews $model */

$this->title = 'Update Category News: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Category News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="category-news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
