<?php
Yii::setAlias('@webroot', $_SERVER['DOCUMENT_ROOT']);

$config = [
    'id' => 'main2',
    'basePath' => dirname(__DIR__),
    'defaultRoute' => 'site/index',
    'vendorPath' => '@webroot/vendor',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',

    'modules' => require 'modules.php',

    'components' => [

        'errorHandler' => [
            //'errorAction' => '/frontend/site/error',
        ],

        'user' => [
            'loginUrl' => ['/user/user/login'],
        ],

        'formatter' => [
            'locale' => 'ru-Ru',
            'dateFormat' => 'long',
            'defaultTimeZone' => 'Europe/Moscow',
            'currencyCode' => 'RUB',
        ],

        'db' => require 'db.php',

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
        ],
    ],
];

$config['components']['request']['cookieValidationKey'] = $config['id'];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
