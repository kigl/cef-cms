<?php
return [
    'modules' => [
        'comment' => [
            'class' => 'kigl\cef\module\comment\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@kigl/cef/module/comment/migrations',
                ]
            ],
        ],
    ],
];