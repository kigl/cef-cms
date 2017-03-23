<?php
return [
    'bootstrap' => ['log'],

    'components' => [
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kigl/cef/core/messages',
                    'fileMap' => [
                        'app' => 'app.php',
                    ],
                ],
            ],
        ],

        'request' => [
            'enableCsrfValidation' => true,
        ],

        'view' => [
            'class' => 'kigl\cef\core\web\View',
        ],

        // ??? Куда вынести
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

        // ??? Куда вынести
        'user' => [
            'identityClass' => 'kigl\cef\module\user\models\UserIdentity',
            'enableAutoLogin' => false,
        ],

        'authManager' => [
            'class' => 'yii\rbac\DbManager',
            // ??? Куда вынести
            'defaultRoles' => ['guest'],
        ],

        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            //'useFileTransport' => true,
        ],

        // ??? Куда вынести
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
    ]
];