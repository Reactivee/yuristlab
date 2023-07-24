<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\GetJob $model */

$this->title = 'Create Get Job';
$this->params['breadcrumbs'][] = ['label' => 'Get Jobs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="get-job-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
