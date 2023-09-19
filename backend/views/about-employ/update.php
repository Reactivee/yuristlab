<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\user\AboutEmploy $model */

$this->title = 'Update About Employ: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'About Employs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="about-employ-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
