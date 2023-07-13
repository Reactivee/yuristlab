<?php

/* @var $this View view component instance */
/* @var $message MessageInterface the message being composed */
/* @var $content string main view render result */

use yii\mail\MessageInterface;
use yii\web\View;

?>
<?php $this->beginPage() ?>
<?php $this->beginBody() ?>
<?php echo $content ?>
<?php $this->endBody() ?>
<?php $this->endPage() ?>
