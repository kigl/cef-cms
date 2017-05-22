<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Пользователи', 'url' => ['/users/backend-default']],
            ],
        ],

        'users' => [
            'class' => 'app\modules\users\Module',
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