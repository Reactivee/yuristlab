<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\user\Hobbies $model */

$this->title = 'Create Hobbies';
$this->params['breadcrumbs'][] = ['label' => 'Hobbies', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="hobbies-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
