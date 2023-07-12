<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
//        'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css',
    ];
    public $js = [
//        'https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
