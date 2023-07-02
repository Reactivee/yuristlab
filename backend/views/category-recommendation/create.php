<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\documents\CategoryRecommendation $model */

$this->title = 'Create Category Recommendation';
$this->params['breadcrumbs'][] = ['label' => 'Category Recommendations', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-recommendation-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
