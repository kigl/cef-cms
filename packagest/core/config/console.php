<?php
$config = [
    'bootstrap' => ['log'],

    'components' => [

        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    // ??? Куда вынести
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
