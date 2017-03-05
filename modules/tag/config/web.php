<?php

return [
    'modules' => [
        'backend' => [
            'modules' => [
                'tag' => [
                    'class' => \app\modules\tag\Module::class,
                    'controllerNamespace' => 'app\modules\tag\controllers\backend',
                    'viewPath' => '@app/modules/tag/views/backend',
                ],
            ],
        ],

        'tag' => [
            'class' => \app\modules\tag\Module::class,
            'controllerNamespace' => 'app\modules\tag\controllers\frontend',
            'viewPath' => '@app/modules/tag/views/frontend',
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'tag' => [
                    'class'   => 'yii\i18n\PhpMessageSource',
                    'basePath'=> '@app/modules/tag/messages',
                    'fileMap' => [
                        'tag' => 'module.php',
                    ],
                ],
            ],
        ],
    ],
];