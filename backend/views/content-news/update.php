<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\ContentNews $model */

$this->title = 'Update Content News: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Content News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="content-news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
