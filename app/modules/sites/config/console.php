<?php
return [
    'modules' => [
        'sites' => [
            'class' => 'app\modules\sites\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/sites/migrations',
                ]
            ],
        ],
    ],
];