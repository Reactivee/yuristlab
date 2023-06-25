<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\GroupDocuments $model */

$this->title = 'Update Group Documents: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Group Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="group-documents-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
