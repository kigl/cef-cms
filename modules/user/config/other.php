<?php
return [
    'toolbar' => [
        'user' => [
            [
                'label' => Yii::t('app', 'Toolbar properties'),
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
                'active' => Yii::$app->controller->module->id == 'user',
            ],
        ],
    ]
];
