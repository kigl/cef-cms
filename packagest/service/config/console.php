<?php
return [
    'modules' => [
        'service' => [
            'class' => 'kigl\cef\module\service\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@kigl/cef/module/service/migrations',
                ]
            ],
        ],
    ],
];