<?php
return [
    'modules' => [
        'site' => [
            'class' => 'app\modules\site\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/site/migrations',
                ]
            ],
        ],
    ],
];