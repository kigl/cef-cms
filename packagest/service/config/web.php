<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'service' => [
                    'class' => 'kigl\cef\module\service\Module',
                    'controllerNamespace' => 'kigl\cef\module\service\controllers\backend',
                    'viewPath' => '@kigl/cef/module/service/views/backend',
                    'controllerMap' => [
                        'default' => 'kigl\cef\module\backend\controllers\DefaultController',
                    ],
                ],
            ],
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'service' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kigl/cef/module/service/messages',
                    'fileMap' => [
                        'service' => 'module.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
        ],
    ],
];