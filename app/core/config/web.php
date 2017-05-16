<?php
Yii::setAlias('@webroot', $_SERVER['DOCUMENT_ROOT']);
Yii::setAlias('@app', dirname(dirname(__DIR__)));

$config = [
    'id' => 'CEF-CMS',
    'basePath' => '@app',
    'defaultRoute' => 'site/index',
    'vendorPath' => '@webroot/vendor',
    'language' => 'ru-RU',
    'sourceLanguage' => 'en-US',
    'tempPath' => '@app/temp',

    'modules' => require 'modules.php',

    'layout' => '@app/templates/black/layouts/column_1.php',

    'components' => [

        'sitemap' => [
            'class' => \app\core\components\sitemap\Sitemap::className(),
            'models' => [
                \app\modules\infosystem\models\Item::className(),
                \app\modules\infosystem\models\Group::className(),
                \app\modules\page\models\Page::className(),
            ],
        ],

        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/core/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            'defaultRoles' => ['guest'],
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'useFileTransport' => true,
        ],

        'errorHandler' => [
            //'errorAction' => '/frontend/site/error',
        ],

        'formatter' => [
            'locale' => 'ru-Ru',
            'dateFormat' => 'dd.MM.yyyy',
            'defaultTimeZone' => 'Europe/Moscow',
            'currencyCode' => 'RUB',
        ],

        'db' => require 'db.php',


        'cache' => [
            'class' => 'yii\caching\FileCache',
            //'class' => \yii\caching\DummyCache::class,
        ],


        'user' => [
            'identityClass' => 'app\modules\user\models\UserIdentity',
            'enableAutoLogin' => false,
            'loginUrl' => ['/user/user/login'],
        ],

        'view' => [
            'class' => 'app\core\web\View',
            'theme' => [
                'basePath' => '@app/templates/black',
                'baseUrl' => '@web/app/templates/black',
                'pathMap' => [
                    '@app/views' => '@app/templates/black/views',
                    '@app/modules' => '@app/templates/black/modules',
                ],
            ],
        ],

        'assetManager' => [
            'basePath' => '@webroot/public/assets',
            'baseUrl' => '@web/public/assets',
            'appendTimestamp' => true,
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    'jsOptions' => ['position' => \yii\web\View::POS_HEAD],
                ],
            ],
        ],

        'urlManager' => [
            'enablePrettyUrl' => true,
            'enableStrictParsing' => false,
            'showScriptName' => false,
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
    ],
];

$config['components']['request']['cookieValidationKey'] = $config['id'];

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
