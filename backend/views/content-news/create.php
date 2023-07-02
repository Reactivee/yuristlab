<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\ContentNews $model */

$this->title = 'Create Content News';
$this->params['breadcrumbs'][] = ['label' => 'Content News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
