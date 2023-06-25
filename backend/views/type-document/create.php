<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\TypeDocuments $model */

$this->title = 'Create Type Documents';
$this->params['breadcrumbs'][] = ['label' => 'Type Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="type-documents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
