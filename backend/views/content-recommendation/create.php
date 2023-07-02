<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\ContentRecommendation $model */

$this->title = 'Create Content Recommendation';
$this->params['breadcrumbs'][] = ['label' => 'Content Recommendations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="content-recommendation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
