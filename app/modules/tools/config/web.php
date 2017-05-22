<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Инструменты', 'url' => ['/tools/backend-default']],
            ],
        ],
        'tools' => [
            'class' => 'app\modules\tools\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Файловый менеджер', 'url' => ['backend-file-manager/index']],
                    ['label' => 'Консоль', 'url' => ['backend-console/index']],
                ],
            ],
        ],
    ],
];