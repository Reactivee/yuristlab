<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\user\SocialEmploy $model */

$this->title = 'Update Social Employ: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Social Employs', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="social-employ-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
