<?php
return [
    'modules' => [
        'lists' => [
            'class' => 'app\modules\lists\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/lists/migrations',
                ]
            ],
        ],
    ],
];