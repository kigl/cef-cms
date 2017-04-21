<?php
return [
    'modules' => [
        'menu' => [
            'class' => 'app\modules\menu\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/menu/migrations',
                ]
            ],
        ],
    ],
];