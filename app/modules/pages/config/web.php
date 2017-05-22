<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Страницы', 'url' => ['/pages/backend-default']],
            ],
        ],
        'pages' => [
            'class' => 'app\modules\pages\Module',
            'dynamicDataPath' => '@app/modules/pages/dynamicData',
            'toolbar' => [
                'main' => [
                    ['label' => 'Страницы', 'url' => ['backend-page/manager']],
                ],
            ],
        ],
    ],

    'components' => [
        'urlManager' => [
            'rules' => [
                ['class' => 'app\modules\pages\components\PageRule'],
            ],
        ],
    ],
];