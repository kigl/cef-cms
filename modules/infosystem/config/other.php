<?php
return [
    'toolbar' => [
        'infosystem' => [
            [
                'label' => Yii::t('infosystem', 'Toolbar infosystems'),
                'url' => ['infosystem/manager']
            ],
        ],
    ],
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-info-circle"></i>&nbsp;' . Yii::t('infosystem', 'Module name'),
                'url' => ['/backend/infosystem'],
                'active' => Yii::$app->controller->module->id == 'infosystem',
            ],
        ],
    ]
];