<?php
return [
    'toolbar' => [
        'tag' => [
            ['label' => Yii::t('tag', 'Toolbar tags'), 'url' => ['tag/manager']],
        ]
    ],
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-tags"></i>&nbsp;' . Yii::t('tag', 'Module name'),
                'url' => ['/backend/tag'],
                'active' => Yii::$app->controller->module->id == 'tag',
            ],
        ],
    ]
];