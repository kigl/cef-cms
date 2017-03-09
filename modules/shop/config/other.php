<?php
return [
    'toolbar' => [
        'shop' => [
            ['label' => Yii::t('shop', 'Toolbar products'), 'url' => ['group/manager']],
            ['label' => Yii::t('shop', 'Toolbar product properties'), 'url' => ['property/manager']],
            ['label' => Yii::t('shop', 'Toolbar order'), 'url' => ['order/manager']],
        ],
    ],
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-shopping-cart"></i>&nbsp;' . Yii::t('shop', 'Module name'),
                'url' => ['/backend/shop'],
                'active' => Yii::$app->controller->module->id == 'shop',
            ],
        ],
    ]
];
