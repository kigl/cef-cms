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
                        'default' => [
                            'class' => 'kigl\cef\module\backend\controllers\DefaultController',
                        ],
                    ],
                    'toolbar' => [
                        ['label' => 'Меню', 'url' => ['/backend/service/menu/menu/manager']],
                        ['label' => 'Формы', 'url' => ['/backend/service/form/form/manager']],
                        ['label' => 'Списки', 'url' => ['/backend/service/lists/list/manager']],
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