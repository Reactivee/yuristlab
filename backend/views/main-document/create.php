<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\MainDocument $model */

$this->title = 'Create Main Document';
$this->params['breadcrumbs'][] = ['label' => 'Main Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
