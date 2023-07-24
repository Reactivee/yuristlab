<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Employ $model */

$this->title = 'Create Employ';
$this->params['breadcrumbs'][] = ['label' => 'Employs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employ-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
