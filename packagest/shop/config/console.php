<?php
return [
    'modules' => [
        'shop' => [
            'class' => 'kigl\cef\module\shop\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@kigl/cef/module/shop/migrations',
                ]
            ],
        ],
    ],
];