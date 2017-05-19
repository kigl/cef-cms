<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Сайты', 'url' => ['/site/backend-default']],
            ],
        ],
        'site' => [
            'class' => 'app\modules\site\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Сайты', 'url' => ['backend-site/manager']],
                    ['label' => 'Шаблоны', 'url' => ['backend-template/manager']],
                ],
            ],
        ],
    ],
];