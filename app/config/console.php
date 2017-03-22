<?php
Yii::setAlias('@webroot', ROOT_DIR);

$config = [
    'id' => 'main2-console',
    'basePath' => dirname(__DIR__),

    'vendorPath' => '@webroot/vendor',

    'modules' => [
        'user' => [
            'class' => 'kigl\cef\module\user\Module',
            //'controllerNamespace' => 'kigl\cef\module\user\commands',
        ],
    ],

    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'db' => require(__DIR__ . '/db.php'),

    ],
];

return $config;
