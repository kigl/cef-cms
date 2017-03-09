<?php
return [
    'toolbar' => [
        'service' => [
            ['label' => Yii::t('service', 'Toolbar menu'), 'url' => ['/backend/service/menu/menu/manager']],
            ['label' => Yii::t('service', 'Toolbar forms'), 'url' => ['/backend/service/form/form/manager']],
        ],
    ],
    'menu' => [
        'service' => [
            [
                'label' => '<i class="fa fa-cubes"></i>&nbsp;' . Yii::t('service', 'Module name'),
                'url' => ['/backend/service/default/index'],
                'active' => Yii::$app->controller->module->id == 'service',
            ],
        ],
    ]
];