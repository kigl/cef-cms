<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'service' => [
                    'class' => 'app\modules\service\Module',
                    'controllerNamespace' => 'app\modules\service\controllers\backend',
                    'viewPath' => '@app/modules/service/views/backend',
                    'modules' => [
                        'form' => [
                            'class' => 'app\modules\service\modules\form\Module',
                            'controllerNamespace' => 'app\modules\service\modules\form\controllers\backend',
                            'viewPath' => '@app/modules/service/modules/form/views/backend',
                        ],
                        'menu' => [
                            'class' => 'app\modules\service\modules\menu\Module',
                            'controllerNamespace' => 'app\modules\service\modules\menu\controllers\backend',
                            'viewPath' => '@app/modules/service/modules/menu/views/backend',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'service' => [
                    'class'   => 'yii\i18n\PhpMessageSource',
                    'basePath'=> '@app/modules/service/messages',
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