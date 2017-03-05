<?php
$config = [
    'id' => 'main2',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log'],

    'defaultRoute' => 'site/index',

    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',

    'vendorPath' => '@app/core/vendor',
];

Yii::setAlias('app', $config['basePath']);

$config['components'] = include __DIR__ .'/components.php';

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
