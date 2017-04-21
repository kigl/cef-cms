<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Меню', 'url' => ['/menu/backend-default']],
            ],
        ],
        'menu' => [
            'class' => 'app\modules\menu\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Меню', 'url' => ['/menu/backend-menu/manager']],
                ],
            ],
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'menu' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/menu/messages',
                    'fileMap' => [
                        'menu' => 'module.php',
                    ],
                ],
            ],
        ],
    ],
];