<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'comment' => [
                    'class' => 'kigl\cef\module\comment\Module',
                    'controllerNamespace' => 'kigl\cef\module\comment\controllers\backend',
                    'viewPath' => '@kigl/cef/module/comment/views/backend',
                    'controllerMap' => [
                        'default' => 'kigl\cef\module\backend\controllers\DefaultController',
                    ],
                ],
            ],
        ],
        'comment' => [
            'class' => 'kigl\cef\module\comment\Module',
            'controllerNamespace' => 'kigl\cef\module\comment\controllers\frontend',
            'viewPath' => '@kigl/cef/module/comment/views/frontend',
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'comment' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kigl/cef/module/comment/messages',
                    'fileMap' => [
                        'comment' => 'module.php',
                    ],
                ],
            ],
        ],
    ]
];