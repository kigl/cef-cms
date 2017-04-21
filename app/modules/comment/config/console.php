<?php
return [
    'modules' => [
        'comment' => [
            'class' => 'app\modules\comment\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/comment/migrations',
                ]
            ],
        ],
    ],
];