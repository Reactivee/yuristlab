<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\user\AboutEmploy $model */

$this->title = 'Create About Employ';
$this->params['breadcrumbs'][] = ['label' => 'About Employs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="about-employ-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
