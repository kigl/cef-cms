<?php
$config = [
    'id' => 'main2',
    'basePath' => dirname(dirname(__FILE__)),
    'bootstrap' => ['log', 'setting'],

    'defaultRoute' => 'site/index',

    'language' => 'ru-RU',

    'components' => [
        'i18n' => array(
            'translations' => array(
                'app' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'fileMap'   => array(
                        'app'=> 'app.php',
                    ),
                ),
            ),
        ),

        'formatter' => [
            'dateFormat' => 'medium',
            'defaultTimeZone' => 'Europe/Moscow',
        ],

        'request' => [
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'main2',
        ],

        'setting' => [
            'class' => 'app\components\DbSetting',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        /*
        'view' => [
            'class' => 'app\modules\main\components\View',
            'theme' => [
                'pathMap'  => [
                    '@app/views' => ['@app/themes/basic'],
                ],
                'basePath' => '@app/themes/basic',
                'baseUrl' => '@web/protected/themes/basic',
            ],
        ],
        */

        'assetManager' => [
            'basePath' => '@webroot/public/assets',
            'baseUrl' => '@web/public/assets',
            'appendTimestamp' => false,
        ],

        'user' => [
            'identityClass' => 'app\modules\user\models\User',
            'enableAutoLogin' => false,
            'loginUrl' => ['/user/default/login'],
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

        'errorHandler' => [
            //'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

        'db' => require(__DIR__ . '/db.php'),

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
            'rules' => [
                '/' => 'site/index',
            ],
        ],

    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
