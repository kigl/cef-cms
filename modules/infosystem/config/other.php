<?php
return [
    'toolbar' => [
    ],
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-info-circle"></i>&nbsp;' . Yii::t('infosystem', 'Module name'),
                'url' => ['/backend/infosystem/infosystem/manager'],
                'active' => Yii::$app->controller->module->id == 'infosystem',
            ],
        ],
    ]
];