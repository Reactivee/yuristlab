<?php

use yii\httpclient\JsonParser;

$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);
require_once __DIR__ . '/../../common/helpers/helpers.php';

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
        'gridview' => ['class' => 'kartik\grid\Module', 'downloadAction' => 'gridview/export/download',],
//        'admin' => [
//            'class' => 'backend\modules\admin\Module',
//            'controllerMap' => [
//                'assignment' => [
//                    'class' => 'mdm\admin\controllers\AssignmentController',
//                    'idField' => 'id',
//                    'usernameField' => 'username',
//                ],
//            ],
////            'layout' => '@backend/modules/admin/views/layouts/main__.php',
//        ],
        'admin' => [
            'class' => 'backend\modules\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'idField' => 'id',
                    'usernameField' => 'username',
                ],
            ],
            'layout' => '@backend/modules/admin/views/layouts/main.php',
        ],
    ],
    'homeUrl' => '/home',
    'components' => [
//        'request' => [
//            'csrfParam' => '_csrf-api',
//            'baseUrl' => '/home',
//            'parsers' => [
//                'application/json' => JsonParser::class,
//            ]
//        ],
        'i18n' => [
            'translations' => [
                '*' => [
                    'class' => 'yii\i18n\DbMessageSource',
                    'db' => 'db',
                    'sourceLanguage' => 'ru',
                    'sourceMessageTable' => '{{%language_source}}',
                    'messageTable' => '{{%language_translate}}',
                    'cachingDuration' => 86400,
                    'forceTranslation'=>true,
                    'enableCaching' => false,
                ],
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'kartik\form\ActiveFormAsset' => [
                    'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle
                ],
                'deyraka\materialdashboard\web\MaterialDashboardAsset',

            ]

        ],
        'formatter' => [
            'class' => 'yii\i18n\Formatter',
            'dateFormat' => 'php:d-M-Y',
            'datetimeFormat' => 'php:d-M-Y H:i:s',
            'timeFormat' => 'php:H:i:s',
            'defaultTimeZone' => 'Asia/Tashkent',
            'timeZone' => 'Asia/Tashkent'
        ],
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/home',
            'parsers' => [
                'application/json' => JsonParser::class,
            ]
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
            //'scriptUrl'=>'/backend/index.php',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],

    ],
    'params' => $params,
    'as access' => [
        'class' => 'backend\modules\admin\components\AccessControl',
        'allowActions' => [
            'site/login',
            'site/logout',
            'site/error',
        ]
    ],

];
