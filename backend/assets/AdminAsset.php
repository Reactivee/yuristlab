<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AdminAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/backend.css',
        'css/print.css',
        'css/style.css'

    ];
    public $js = [
        //'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.bundle.min.js',
//        'js/main.js',
//        'js/jquery.caret.js',
//        'js/jquery.mobilePhoneNumber.js',
//        'js/sweetalert.js',
    ];
    /*public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];*/
    public $depends = [
        'backend\extensions\adminlte\assets\AdminLteAsset'
    ];
}