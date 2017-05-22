<?php
return [
    'modules' => [
        'users' => [
            'class' => 'app\modules\users\Module',
            'controllerNamespace' => 'app\modules\users\commands',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/user/migrations',
                ]
            ],
        ],
    ],
];