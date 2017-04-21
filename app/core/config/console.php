<?php
Yii::setAlias('@webroot', ROOT_DIR);

$config = [
    'id' => 'main2-console',
    'basePath' => dirname(dirname(__DIR__)),

    'vendorPath' => '@webroot/vendor',

    'controllerNamespace' => 'app\commands',

    'components' => [
        'db' => require 'db.php',

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    // ??? Куда вынести
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
];

return $config;
