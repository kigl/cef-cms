<?php
Yii::setAlias('@webroot', $_SERVER['DOCUMENT_ROOT']);

$config = [
    'id' => 'CEF-CMS',
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

        'formatter' => [
            'locale' => 'ru-Ru',
            'dateFormat' => 'dd.MM.yyyy',
            'defaultTimeZone' => 'Europe/Moscow',
            'currencyCode' => 'RUB',
        ],

        'db' => require 'db.php',

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => ['/user/user/login'],
        ],


        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
        ],

        'assetManager' => [
            'basePath' => '@webroot/public/assets',
            'baseUrl' => '@web/public/assets',
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                ],
            ],
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
