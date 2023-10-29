<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
require_once __DIR__ . '/../../common/helpers/helpers.php';

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'gridview' => [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],
    'components' => [
        'formatter' => [
            'class'           => 'yii\i18n\Formatter',
            'defaultTimeZone' => 'Asia/Tashkent',
        ],
        'response' => [
            'formatters' => [
                'json' => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG,
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCsrfValidation' => false,
        ],
//        'modules' => [
//            'gridview' => ['class' => 'kartik\grid\Module', 'downloadAction' => 'gridview/export/download'],
//        ],
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
//                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
            ],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'yurist-frontend',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],

        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',
//            'enableDefaultLanguageUrlCode' => true,
//            'enableLanguagePersistence' => false,
            'languages' => ['uz', 'ru', 'en'],
            'enableLanguageDetection' => false,
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [

                'locations' => 'site/locations',
                '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>/<slug:\w+>' => '<controller>/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
                ['pattern' => 'sitemap', 'route' => 'sitemap/default/index', 'suffix' => '.xml'],
            ],
        ],

    ],
    'params' => $params,
    'as access' => [
        'class' => 'backend\modules\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/signup',
            'site/logout',
            'site/error',
        ]
    ],
];
