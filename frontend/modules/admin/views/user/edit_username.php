<?php

use common\models\User;
use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var User $model */
?>


<div class="user-form">

    <?php

    $form = ActiveForm::begin(); ?>

    <?php echo
    $form->field($model, 'username')->textInput() ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('rbac-admin', 'Create') : Yii::t('rbac-admin', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
