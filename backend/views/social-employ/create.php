<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\user\SocialEmploy $model */

$this->title = 'Create Social Employ';
$this->params['breadcrumbs'][] = ['label' => 'Social Employs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="social-employ-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
