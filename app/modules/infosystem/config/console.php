<?php
return [
    'modules' => [
        'infosystem' => [
            'class' => 'app\modules\infosystem\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/infosystem/migrations',
                ]
            ],
        ],
    ],
];