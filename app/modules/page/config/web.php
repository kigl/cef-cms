<?php
return [
    'modules' => [
        'backend' => [
            'menuItems' => [
                ['label' => 'Страницы', 'url' => ['/page/backend-default']],
            ],
        ],
        'page' => [
            'class' => 'app\modules\page\Module',
            'dynamicDataPath' => '@app/modules/page/dynamicData',
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
                ['class' => 'app\modules\page\components\PageRule'],
            ],
        ],
    ],
];