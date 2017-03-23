<?php
return [
    'modules' => [
        'tag' => [
            'class' => 'kigl\cef\module\tag\Module',
            'controllerNamespace' => 'kigl\cef\module\tag\commands',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@kigl/cef/module/tag/migrations',
                ]
            ],
        ],
    ],
];