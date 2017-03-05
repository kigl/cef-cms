<?php
return [
    'toolbar' => [
        'user' => [
            [
                'label' => Yii::t('user', 'Toolbar field'),
                'url' => ['field/manager'],
            ],
            ['label' => Yii::t('user', 'Toolbar rbac'), 'url' => ['rbac/manager']],
        ],
    ],
    'menu' => [
        'other' => [
            [
                'label' => '<i class="fa fa-user"></i>&nbsp;' . Yii::t('user', 'Module name'),
                'url' => ['/backend/user/default/manager'],
            ],
        ],
    ]
];
