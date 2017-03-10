<?php
return [
    'toolbar' => [
        'user' => [
            ['label' => Yii::t('user', 'Toolbar users'), 'url' => ['user/manager']],
            [
                'label' => Yii::t('user', 'Toolbar user properties'),
                'url' => ['property/manager'],
            ],
            ['label' => Yii::t('user', 'Toolbar RBAC'), 'url' => ['rbac/manager']],
            [
                'label' => Yii::t('app', 'Toolbar setting'),
                'url' => ['default/setting'],
                'options' => ['class' => 'pull-right']
            ],
        ],
    ],
    'menu' => [
        'other' => [
            [
                'label' => '<i class="fa fa-user"></i>&nbsp;' . Yii::t('user', 'Module name'),
                'url' => ['/backend/user'],
                'active' => Yii::$app->controller->module->id == 'user',
            ],
        ],
    ]
];
