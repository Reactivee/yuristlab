<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\news\LawNews $model */

$this->title = 'Update Law News: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Law News', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="law-news-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
