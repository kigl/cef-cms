<?php

use app\modules\shop\Module;

return [
    'modules' => [
        'admin' => [
            'modules' => [
                'shop' => [
                    'class' => Module::className(),
                    'controllerNamespace' => 'app\modules\shop\controllers\backend',
                    'viewPath' => '@app/modules/shop/views/backend',
                ],
            ],
        ],

        'shop' => [
            'class' => Module::className(),
            'controllerNamespace' => 'app\modules\shop\controllers\frontend',
            'viewPath' => '@app/modules/shop/views/frontend',
            'urlAlias' => true,
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'shop' => [
                    'class' => 'yii\i18n\phpMessageSource',
                    'basePath' => '@app/modules/shop/messages',
                    'fileMap' => [
                        'shop' => 'module.php',
                    ],
                ],
            ],
        ],
        'urlManager' => [
            'rules' => [
                '/shop/group/<id>' => '/shop/group/view',
                '/shop/groups' => '/shop/group/list',
                '/shop/product/<id>' => '/shop/product/view',
            ],
        ],
    ],
];