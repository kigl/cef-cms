<?php

use app\modules\shop\Module;

return [
    'modules' => [
        'backend' => [
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
        ],

        'gridview' =>  [
            'class' => '\kartik\grid\Module',
        ]
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
        'cart' => [
            'class' => \app\modules\shop\components\cart\Cart::className(),
            'cookieName' => 'cart',
            'cookieExpire' => time() + 3600 * 24 * 1,
        ],
        'urlManager' => [
            'rules' => [
                'shop/group/<id>/<alias>' => '/shop/group/view',
                'shop/group/<id>' => '/shop/group/view',
                'shop/search' => '/shop/product/search',
                'shop/product/<id:\d+>/<alias>' => '/shop/product/view',
                'shop/product/<id:\d+>' => '/shop/product/view',
                'shop/cart' => '/shop/cart/index',
                'shop/order' => '/shop/order/index',
            ],
        ],
    ],
];