<?php
return [
    'menu' => [
        'content' => [
            [
                'label' => '<i class="fa fa-comments"></i>&nbsp;' . Yii::t('comment', 'Module name'),
                'url' => ['/backend/comment/default/manager'],
                'active' => Yii::$app->controller->module->id == 'comment',
            ],
        ],
    ]
];