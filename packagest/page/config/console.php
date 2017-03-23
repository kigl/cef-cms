<?php
return [
    'modules' => [
        'page' => [
            'class' => 'kigl\cef\module\page\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@kigl/cef/module/page/migrations',
                ]
            ],
        ],
    ],
];