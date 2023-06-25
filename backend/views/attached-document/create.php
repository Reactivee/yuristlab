<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\AttachedDocument $model */

$this->title = 'Create Attached Document';
$this->params['breadcrumbs'][] = ['label' => 'Attached Documents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="attached-document-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
