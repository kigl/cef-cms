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
                        'label' => 'Инфосистемы',
                        'url' => ['backend-infosystem/manager']
                    ],
                    ['label' => 'Метки', 'url' => ['backend-tag/manager']],
                ],
            ],
        ],
    ],

    'components' => [
        'urlManager' => [
            'rules' => [
                ['class' => \app\modules\infosystem\components\urlRules\UrlRule::class],
            ],
        ],
    ],
];