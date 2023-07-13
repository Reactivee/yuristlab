<?php

use backend\modules\admin\models\form\User as UserForm;

/* @var $this yii\web\View */
/* @var $model UserForm */

$this->title = Yii::t('rbac-admin', 'Create User');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-update box box-success">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
