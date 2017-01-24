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
        ],

        'gridview' =>  [
            'class' => '\kartik\grid\Module'
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ]
    ],

    //'bootstrap' => ['cart'],

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
                '/shop/group/<id>/<alias>' => '/shop/group/view',
                '/shop/group/<id>' => '/shop/group/view',
                '/shop/search' => '/shop/product/search',
                '/shop/product/<id>/<alias>' => '/shop/product/view',
                '/shop/product/<id>' => '/shop/product/view',
                '/shop/cart' => '/shop/cart/index',
                '/shop/order' => '/shop/order/index',
            ],
        ],
    ],
];