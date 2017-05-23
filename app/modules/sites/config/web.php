<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Сайты', 'url' => ['/sites/backend-default']],
            ],
        ],
        'sites' => [
            'class' => 'app\modules\sites\Module',
            'toolbar' => [
                'main' => [
                    ['label' => 'Сайты', 'url' => ['backend-site/manager']],
                    //['label' => 'Шаблоны', 'url' => ['backend-template/manager']],
                ],
            ],
        ],
    ],
];