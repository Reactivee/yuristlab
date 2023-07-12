<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\news\LawNews $model */

$this->title = 'Create Law News';
$this->params['breadcrumbs'][] = ['label' => 'Law News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="law-news-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
