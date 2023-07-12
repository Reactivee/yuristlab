<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\news\LawContent $model */

$this->title = 'Create Law Content';
$this->params['breadcrumbs'][] = ['label' => 'Law Contents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="law-content-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
