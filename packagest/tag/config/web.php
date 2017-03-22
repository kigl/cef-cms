<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'tag' => [
                    'class' => 'kigl\cef\module\tag\Module',
                    'controllerNamespace' => 'kigl\cef\module\tag\controllers\backend',
                    'viewPath' => '@kigl/cef/module/tag/views/backend',
                    'controllerMap' => [
                        'default' => 'kigl\cef\module\backend\controllers\DefaultController',
                    ],
                    'toolbar' => [
                        ['label' => 'Теги', 'url' => ['tag/manager']],
                    ],
                ],
            ],
        ],

        'tag' => [
            'class' => 'kigl\cef\module\tag\Module',
            'controllerNamespace' => 'kigl\cef\module\tag\controllers\frontend',
            'viewPath' => '@kigl/cef/module/tag/views/frontend',
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'tag' => [
                    'class'   => 'yii\i18n\PhpMessageSource',
                    'basePath'=> '@kigl/cef/module/tag/messages',
                    'fileMap' => [
                        'tag' => 'module.php',
                    ],
                ],
            ],
        ],
    ],
];