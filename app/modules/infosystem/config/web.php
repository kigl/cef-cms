<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Информационные системы', 'url' => ['/infosystem/backend-default']],
            ],
        ],

        'infosystem' => [
            'class' => 'app\modules\infosystem\Module',
            'toolbar' => [
                'main' => [
                    [
                        'label' => 'Инфо-системы',
                        'url' => ['backend-infosystem/manager']
                    ],
                ],
            ],
        ],
    ],

    'components' => [
        'urlManager' => [
            'rules' => [
                ['class' => \app\modules\infosystem\components\UrlRule::class],
            ],
        ],
    ],
];