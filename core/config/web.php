<?php
$config = [
    'id' => 'main2',
    'basePath' => dirname(dirname(__DIR__)),
    'bootstrap' => ['log', 'setting'],

    'defaultRoute' => 'site/index',

    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',

    'vendorPath' => '@app/core/vendor',

    'components' => [
        'i18n' => array(
            'translations' => array(
                'app' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/core/messages',
                    'fileMap' => array(
                        'app' => 'app.php',
                    ),
                ),
            ),
        ),

        'formatter' => [
            'locale' => 'ru-Ru',
            'dateFormat' => 'long',
            'defaultTimeZone' => 'Europe/Moscow',
            'currencyCode' => 'RUB',
        ],

        'request' => [
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'main2',

            /*
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
             */
        ],

        'setting' => [
            'class' => 'app\core\components\DbSetting',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

/*
        'view' => [
            'class' => 'app\core\web\View',

            'theme' => [
                'pathMap'  => [
                    '@app/views' => ['@app/themes/basic'],
                ],
                'basePath' => '@app/themes/basic',
                'baseUrl' => '@web/app/themes/basic',
            ],

        ],
*/

        'view' => [
            'class' => 'app\core\web\View',
            'theme' => [
                'basePath' => '@app/templates/flat',
                'baseUrl' => '@web/templates/flat',
                'pathMap' => [
                    '@app/views/' => '@app/templates/flat',
                    '@app/modules' => '@app/templates/flat/modules',
                ],
            ],
        ],


        'assetManager' => [
            'basePath' => '@webroot/public/assets',
            'baseUrl' => '@web/public/assets',
            'appendTimestamp' => false,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                ],
            ],
        ],

        'user' => [
            'identityClass' => 'app\modules\user\models\UserIdentity',
            'enableAutoLogin' => false,
            'loginUrl' => ['/user/default/login'],
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

        'errorHandler' => [
            //'errorAction' => '/frontend/site/error',
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

Yii::setAlias('app', $config['basePath']);

return $config;
