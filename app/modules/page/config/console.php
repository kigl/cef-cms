<?php
return [
    'modules' => [
        'page' => [
            'class' => 'app\modules\page\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/page/migrations',
                ]
            ],
        ],
    ],
];