<?php
/* @var $this View */
/* @var $content string */

use yii\web\View;

$controller = $this->context;
$menus = $controller->module->menus;
$route = $controller->route;
foreach ($menus as $i => $menu) {
    $menus[$i]['active'] = strpos($route, trim($menu['url'][0], '/')) === 0;
}
$this->params['nav-items'] = $menus;
$this->params['top-menu'] = true;
?>
<?php $this->beginContent($controller->module->mainLayout) ?>
<div class="row">
    <div class="col-sm-12">
        <?php echo $content ?>
    </div>
</div>
<?php $this->endContent(); ?>
