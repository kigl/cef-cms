<?php
return [
    'content' => [
        [
            'label' => '<i class="fa fa-file-text"></i>&nbsp;' . Yii::t('page', 'Module name'),
            'url' => ['/backend/page/default/manager'],
            'active' => Yii::$app->controller->module->id == 'page',
        ],
    ],
];