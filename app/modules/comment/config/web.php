<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Комментарии', 'url' => ['/comment/backend-default']],
            ],
        ],

        'comment' => [
            'class' => 'app\modules\comment\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Комментарии', 'url' => ['backend-comment/manager']],
                ],
            ],
        ],
    ],
];