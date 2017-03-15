<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'comment' => [
                    'class' => 'app\modules\comment\Module',
                    'controllerNamespace' => 'app\modules\comment\controllers\backend',
                    'viewPath' => '@app/modules/comment/views/backend',
                    'controllerMap' => [
                        'default' => 'app\modules\backend\controllers\DefaultController',
                    ],
                ],
            ],
        ],
        'comment' => [
            'class' => 'app\modules\comment\Module',
            'controllerNamespace' => 'app\modules\comment\controllers\frontend',
            'viewPath' => '@app/modules/comment/views/frontend',
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'comment' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/modules/comment/messages',
                    'fileMap' => [
                        'comment' => 'module.php',
                    ],
                ],
            ],
        ],
    ]
];