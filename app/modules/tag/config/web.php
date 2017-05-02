<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Теги', 'url' => ['/tag/backend-default']],
            ],
        ],

        'tag' => [
            'class' => 'app\modules\tag\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Теги', 'url' => ['backend-tag/manager']],
                ],
            ],
        ],
    ],
];