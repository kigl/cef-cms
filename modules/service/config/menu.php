<?php
return [
    [
        'label' => '<i class="fa fa-cubes"></i>&nbsp;' . Yii::t('service', 'Module name'),
        'url' => ['/backend/service/default/index'],
        'active' => Yii::$app->controller->module->id == 'service',
    ],
];