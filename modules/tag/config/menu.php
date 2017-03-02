<?php
return [
    [
        'label' => '<i class="fa fa-info-circle"></i>&nbsp;' . Yii::t('tag', 'Module name'),
        'url' => ['/backend/tag/default/manager'],
        'active' => Yii::$app->controller->module->id == 'tag',
    ],
];