<?php

/* @var $this View */

use backend\models\menu\Menus;
use backend\modules\admin\components\Helper;
use backend\extensions\adminlte\widgets\Menu;
use yii\web\View;

?>

<aside class="main-sidebar">
    <section class="sidebar">

        <?php echo empty($menuItems = Menus::getMainAdminMenu('admin_menu')) ?
            Yii::t('views', '<pre class="bg-warning">Menu not found.<br>key => "{key}"</pre>', ['key' => 'admin_menu']) :
            Menu::widget([
                'options' => ['class' => 'sidebar-menu'],
                'items' => Helper::filter($menuItems),
            ]);

        ?>

    </section>
</aside>