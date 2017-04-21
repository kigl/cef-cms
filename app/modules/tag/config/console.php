<?php
return [
    'modules' => [
        'tag' => [
            'class' => 'app\modules\tag\Module',
            'controllerNamespace' => 'app\modules\tag\commands',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/tag/migrations',
                ]
            ],
        ],
    ],
];