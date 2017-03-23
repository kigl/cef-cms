<?php
return [
    'modules' => [
        'user' => [
            'class' => 'kigl\cef\module\user\Module',
            'controllerNamespace' => 'kigl\cef\module\user\commands',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@kigl/cef/module/user/migrations',
                ]
            ],
        ],
    ],
];