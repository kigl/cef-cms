<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'user' => [
                    'class' => 'kigl\cef\module\user\Module',
                    'controllerNamespace' => 'kigl\cef\module\user\controllers\backend',
                    'viewPath' => '@kigl/cef/module/user/views/backend',
                    'controllerMap' => [
                        'default' => [
                            'class' => 'kigl\cef\module\backend\controllers\DefaultController',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'user' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kigl/cef/module/user/messages',
                    'fileMap' => [
                        'user' => 'module.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                'login' => '/user/user/login',
                'registration' => '/user/user/registration',
                'personal' => '/user/user/personal',
                'logout' => '/user/user/logout',
            ],
        ],
    ],
];