<?php
return [
    'toolbar' => [
        'page' => [
            ['label' => Yii::t('page', 'Toolbar pages'), 'url' => ['page/manager']],
        ],
    ],
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-file-text"></i>&nbsp;' . Yii::t('page', 'Module name'),
                'url' => ['/backend/page'],
                'active' => Yii::$app->controller->module->id == 'page',
            ],
        ],
    ]
];