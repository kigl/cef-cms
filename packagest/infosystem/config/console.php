<?php
return [
    'modules' => [
        'infosystem' => [
            'class' => 'kigl\cef\module\infosystem\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@kigl/cef/module/infosystem/migrations',
                ]
            ],
        ],
    ],
];