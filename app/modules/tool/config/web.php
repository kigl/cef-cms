<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Инструменты', 'url' => ['/tool/backend-default']],
            ],
        ],
        'tool' => [
            'class' => \app\modules\tool\Module::class,
            'toolbar' => [
                'main' => [
                    ['label' => 'Файловый менеджер', 'url' => ['backend-file-manager/index']],
                    ['label' => 'Консоль', 'url' => ['backend-console/index']],
                ],
            ],
        ],
    ],
];