<?php
return [
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
    ],

    'sitemap' => [
        'class' => \app\core\components\sitemap\Sitemap::class,
    ],

    'cache' => [
        'class' => 'yii\caching\FileCache',
    ],

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
];