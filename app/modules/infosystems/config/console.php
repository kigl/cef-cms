<?php
return [
    'modules' => [
        'infosystems' => [
            'class' => 'app\modules\infosystems\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/infosystems/migrations',
                ]
            ],
        ],
    ],
];