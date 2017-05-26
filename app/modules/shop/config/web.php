<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Интернет-магазин', 'url' => ['/shop/backend-default']],
            ],
        ],

        'shop' => [
            'class' => 'app\modules\shop\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Интернет-магазины', 'url' => ['backend-shop/manager']],
                ],
                'group' => [
                    ['label' => 'Свойства товаров', 'url' => ['backend-property/manager']],
                    ['label' => 'Заказы', 'url' => ['backend-order/manager']],
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
];