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
    ],

    'bootstrap' => ['cart'],

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
            'orderModelClass' => \app\modules\shop\models\base\Order::className(),
            'cartModelClass' => \app\modules\shop\models\base\Cart::className(),
            'cookieKey' => 'cart',
            'cookieTimeDays' => '1',
        ],
        'urlManager' => [
            'rules' => [
                '/shop/group/<id>/<alias>' => '/shop/group/view',
                '/shop/group/<id>' => '/shop/group/view',
                /*
                '/shop/group/<group_id>/<alias>' => '/shop/product/list',
                '/shop/group/<group_id>' => '/shop/product/list',
                */
                '/shop/search' => '/shop/product/search',
                '/shop/product/<id>/<alias>' => '/shop/product/view',
                '/shop/product/<id>' => '/shop/product/view',
            ],
        ],
    ],
];