<?php
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $user mdm\admin\models\User */

$resetLink = Url::to(['user/reset-password','token'=>$user->password_reset_token], true);
?>
Hello <?php echo $user->username ?>,

Follow the link below to reset your password:

<?php echo $resetLink ?>
