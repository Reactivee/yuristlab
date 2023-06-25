<?php


use yii\web\JsonParser;

require_once __DIR__ . '/../../common/helpers/helpers.php';

$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'controllerNamespace' => 'api\controllers',
    //'homeUrl' => '/api',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-api',
            'baseUrl' => '/api',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
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
        'user' => [
            'identityClass' => 'app\models\User', //<= this
            'enableAutoLogin' => true,
            'enableSession' => false,
            'loginUrl' => null,
        ],

        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            //'enableStrictParsing' => true,
//            'rules' => [
//                ['class' => 'yii\rest\UrlRule', 'controller' => 'prizma-v2/price'],

//                ],
        ],

    ],
    'as corsFilter' => [
        'class' => \yii\filters\Cors::className(),
    ],
    'params' => $params,
];


return $config;