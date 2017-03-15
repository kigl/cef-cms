<?php
return [
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',

    'bootstrap' => ['log'],

    'components' => [
        'i18n' => array(
            'translations' => array(
                'app' => array(
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kigl/cef/core/messages',
                    'fileMap' => array(
                        'app' => 'app.php',
                    ),
                ),
            ),
        ),

        /*'configManager' => [
            'class' => \kigl\cef\core\components\ConfigManager::class,
            'modulesPath' => '@app/modules',
            'type' => \kigl\cef\core\components\ConfigManager::CONFIG_TYPE_OTHER,
        ],*/

        'formatter' => [
            'locale' => 'ru-Ru',
            'dateFormat' => 'long',
            'defaultTimeZone' => 'Europe/Moscow',
            'currencyCode' => 'RUB',
        ],

        'request' => [
            'enableCsrfValidation' => true,
            'cookieValidationKey' => 'main2',
        ],

        /*'sitemap' => [
            'class' => \app\core\components\sitemap\Sitemap::class,
        ],*/

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],

        'view' => [
            'class' => 'kigl\cef\core\web\View',
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

        /*'user' => [
            'identityClass' => 'app\modules\user\models\UserIdentity',
            'enableAutoLogin' => false,
            'loginUrl' => ['/user/default/login'],
        ],*/

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

        'errorHandler' => [
            //'errorAction' => '/frontend/site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'useFileTransport' => true,
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

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
        ],
    ]
];