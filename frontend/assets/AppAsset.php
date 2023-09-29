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
//        "https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css",
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css',
        'vendors/jquery-toast-plugin/jquery.toast.min.css',
        'vendors/bootstrap-datepicker/bootstrap-datepicker.min.css',
        'vendors/mdi/css/materialdesignicons.min.css',
        'vendors/css/vendor.bundle.base.css',
        'css/vertical-layout-light/style.css',

        'css/particles.css',
//        'css/percent-preloader.min.css',
        'css/preloader.css',
        'css/site.css'
    ];
    public $js = [
        'https://cdn.jsdelivr.net/npm/signature_pad@4.0.0/dist/signature_pad.umd.min.js',
//        'js/jQuery.spHtmlEditor.js',
        'js/webodf.js',
//        'vendors/bootstrap-datepicker/bootstrap-datepicker.min.js',
        'vendors/js/vendor.bundle.base.js',
//        'https://code.jquery.com/jquery-3.7.1.js',
//        'https://code.jquery.com/jquery-3.4.0.min.js',
        'vendors/chart.js/Chart.min.js',
        'js/off-canvas.js',
        'js/formpickers.js',
//        'js/hoverable-collapse.js',
//        'js/template.js',
//        'js/settings.js',
//        'js/todolist.js',
        'js/dashboard.js',
        'js/chart.js',
//        'js/sign.js',
        'https://unpkg.com/jszip/dist/jszip.min.js',
        'js/docx-preview.js',
//        'js/percent-preloader.min.js',
        'js/jquery.preloadinator.min.js',
        'js/particles.min.js',
        'js/particles_in.js',
        'js/stats.js',
//        'https://code.jquery.com/jquery-3.7.0.min.js',
        'js/main.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
    public $cssOptions = [
        "async" => true,
        'as' => 'style'
    ];
    public $jsOptions = [
        "defer" => true,
        'as' => 'script'
    ];
}
