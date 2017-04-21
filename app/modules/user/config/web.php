<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Пользователи', 'url' => ['/user/backend-default']],
            ],
        ],

        'user' => [
            'class' => 'app\modules\user\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Пользователи', 'url' => ['backend-user/manager']],
                    ['label' => 'Контроль доступа', 'url' => ['backend-rbac/manager']],
                ],
                'user' => [
                    [
                        'label' => 'Свойства пользователей',
                        'url' => ['backend-property/manager'],
                    ],
                ],
            ],
        ],
    ],
];