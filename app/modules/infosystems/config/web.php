<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Информационные системы', 'url' => ['/infosystems/backend-default']],
            ],
        ],

        'infosystems' => [
            'class' => 'app\modules\infosystems\Module',
            'toolbar' => [
                'main' => [
                    [
                        'label' => 'Инфосистемы',
                        'url' => ['backend-infosystem/manager']
                    ],
                ],
                'infosystems' => [
                    ['label' => 'Метки', 'url' => ['backend-tag/manager']],
                ],
            ],
        ],
    ],

    'components' => [
        'urlManager' => [
            'rules' => [
                ['class' => \app\modules\infosystems\components\urlRules\UrlRule::class],
            ],
        ],
    ],
];