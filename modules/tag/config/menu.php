<?php
return [
    'content' => [
        [
            'label' => '<i class="fa fa-tags"></i>&nbsp;' . Yii::t('tag', 'Module name'),
            'url' => ['/backend/tag/default/manager'],
            'active' => Yii::$app->controller->module->id == 'tag',
        ],
    ]
];