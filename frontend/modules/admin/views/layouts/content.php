<?php

/* @var $this View */
/* @var $content string */

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use backend\widgets\AlertGrowl;

?>
<div class="content-wrapper">
    <section class="content-header">
        <h1><?php echo Html::encode($this->title) ?></h1>
        <?php echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
    </section>
    <section class="content">
        <?php echo AlertGrowl::widget() ?>
        <?php echo $content ?>
    </section>
</div>

<footer class="main-footer">
    <strong>&copy; Company <?php echo date('Y') ?>.</strong> All rights reserved.
</footer>
