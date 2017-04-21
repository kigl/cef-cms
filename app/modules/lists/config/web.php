<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Списки', 'url' => ['/lists/backend-default']],
            ],
        ],
        'lists' => [
            'class' => 'app\modules\lists\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Списки', 'url' => ['backend-lists/manager']],
                ],
            ],
        ],
    ],
];