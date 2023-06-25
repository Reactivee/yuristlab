<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\CategoryDocuments $model */

$this->title = 'Create Category Documents';
$this->params['breadcrumbs'][] = ['label' => 'Category Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-documents-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
