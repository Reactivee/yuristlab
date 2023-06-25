<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\GroupDocuments $model */

$this->title = 'Create Group Documents';
$this->params['breadcrumbs'][] = ['label' => 'Group Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="group-documents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
