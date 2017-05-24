<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Формы', 'url' => ['/forms/backend-default']],
            ],
        ],
        'forms' => [
            'class' => 'app\modules\forms\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Формы', 'url' => ['/forms/backend-form/manager']],
                ],
            ],
        ],
    ],
];