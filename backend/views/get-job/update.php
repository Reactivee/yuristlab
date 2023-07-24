<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GetJob $model */

$this->title = 'Update Get Job: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Get Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="get-job-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
