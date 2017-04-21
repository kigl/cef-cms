<?php
return [
    'modules' => [
        'form' => [
            'class' => 'app\modules\form\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/form/migrations',
                ]
            ],
        ],
    ],
];