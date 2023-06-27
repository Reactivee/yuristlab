<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'vendors/mdi/css/materialdesignicons.min.css',
        'vendors/css/vendor.bundle.base.css',
        'css/vertical-layout-light/style.css',
        'images/favicon.png',
    ];
    public $js = [
//        'js/jQuery.spHtmlEditor.js',
        'js/webodf.js',
        'vendors/js/vendor.bundle.base.js',
        'vendors/chart.js/Chart.min.js',
        'js/off-canvas.js',
        'js/hoverable-collapse.js',
        'js/template.js',
        'js/settings.js',
        'js/todolist.js',
        'js/dashboard.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
