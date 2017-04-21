<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Формы', 'url' => ['/form/backend-default']],
            ],
        ],
        'form' => [
            'class' => 'app\modules\form\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Формы', 'url' => ['/form/backend-form/manager']],
                ],
            ],
        ],
    ],
];