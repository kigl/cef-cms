<?php
return [
    'modules' => [
        'forms' => [
            'class' => 'app\modules\forms\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/forms/migrations',
                ]
            ],
        ],
    ],
];