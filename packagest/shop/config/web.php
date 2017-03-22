<?php
return [
    'modules' => [
        'backend' => [
            'modules' => [
                'shop' => [
                    'class' => 'kigl\cef\module\shop\Module',
                    'controllerNamespace' => 'kigl\cef\module\shop\controllers\backend',
                    'viewPath' => '@kigl/cef/module/shop/views/backend',
                    'controllerMap' => [
                        'default' => 'kigl\cef\module\backend\controllers\DefaultController',
                    ],
                    'toolbar' => [
                        ['label' => 'Продукты', 'url' => ['group/manager']],
                        ['label' => 'Свойства продуктов', 'url' => ['property/manager']],
                        ['label' => 'Заказы', 'url' => ['order/manager']],
                    ],
                ],
            ],
        ],

        'shop' => [
            'class' => 'kigl\cef\module\shop\Module',
            'controllerNamespace' => 'kigl\cef\module\shop\controllers\frontend',
            'viewPath' => '@kigl/cef/module/shop/views/frontend',
        ],
    ],

    'components' => [
        'i18n' => [
            'translations' => [
                'shop' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@kigl/cef/module/shop/messages',
                    'fileMap' => [
                        'shop' => 'module.php',
                    ],
                ],
            ],
        ],

        /*'cart' => [
            'class' => \app\modules\shop\components\cart\Cart::className(),
            'cookieName' => 'cart',
            'cookieExpire' => time() + 3600 * 24 * 1,
        ],

        'sitemap' => [
            'models' => \app\modules\shop\models\Product::class,
        ],*/

        'urlManager' => [
            /*'rules' => [
                'shop/group/<id>-<alias>' => '/shop/group/view',
                'shop/group/<id>' => '/shop/group/view',
                'shop/search' => '/shop/product/search',
                'shop/product/<id:\d+>-<alias>' => '/shop/product/view',
                'shop/product/<id:\d+>' => '/shop/product/view',
                'shop/cart' => '/shop/cart/index',
                'shop/order' => '/shop/order/index',
            ],*/
        ],
    ],
];