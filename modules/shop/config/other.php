<?php
return [
    'toolbar' => [
        'shop' => [
            ['label' => Yii::t('app', 'Toolbar properties'), 'url' => ['property/manager']],
            ['label' => Yii::t('shop', 'Toolbar order'), 'url' => ['order/manager']],
        ],
    ],
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-shopping-cart"></i>&nbsp;' . Yii::t('shop', 'Module name'),
                'url' => ['/backend/shop/group/manager']
            ],
        ],
    ]
];
