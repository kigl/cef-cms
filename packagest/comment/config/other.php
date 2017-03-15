<?php
return [
    'toolbar' => [
        'comment' => [
            ['label' => Yii::t('comment', 'Toolbar comments'), 'url' => ['comment/manager']]
        ],
    ],
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-comments"></i>&nbsp;' . Yii::t('comment', 'Module name'),
                'url' => ['/backend/comment'],
                'active' => Yii::$app->controller->module->id == 'comment',
            ],
        ],
    ]
];