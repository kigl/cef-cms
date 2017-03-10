<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'service' => [
                    'class' => 'app\modules\service\Module',
                    'controllerNamespace' => 'app\modules\service\controllers\backend',
                    'viewPath' => '@app/modules/service/views/backend',
                    'controllerMap' => [
                        'default' => 'app\modules\backend\controllers\DefaultController',
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
                    'basePath' => '@app/modules/service/messages',
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