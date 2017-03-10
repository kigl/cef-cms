<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'user' => [
                    'class' => 'app\modules\user\Module',
                    'controllerNamespace' => 'app\modules\user\controllers\backend',
                    'viewPath' => '@app/modules/user/views/backend',
                    'controllerMap' => [
                        'default' => [
                            'class' => 'app\modules\backend\controllers\DefaultController',
                            'settingModelClass' => 'app\modules\user\models\Setting',
                        ],
                    ],
                ],
            ],
        ],

        'user' => [
            'class' => 'app\modules\user\Module',
            'controllerNamespace' => 'app\modules\user\controllers\frontend',
            'viewPath' => '@app/modules/user/views/frontend',
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'user' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/user/messages',
                    'fileMap' => [
                        'user' => 'module.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                'login' => '/user/user/login',
                'registration' => '/user/default/registration',
                'personal' => '/user/default/personal',
                'logout' => '/user/default/logout',
            ],
        ],
    ],
];