<?php
return [
    'modules' => [
        'pages' => [
            'class' => 'app\modules\pages\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/pages/migrations',
                ]
            ],
        ],
    ],
];