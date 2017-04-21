<?php
return [
    'modules' => [
        'shop' => [
            'class' => 'app\modules\shop\Module',
            'controllerMap' => [
                'migrate' => [
                    'class' => 'yii\console\controllers\MigrateController',
                    'migrationPath' => '@app/modules/shop/migrations',
                ]
            ],
        ],
    ],
];