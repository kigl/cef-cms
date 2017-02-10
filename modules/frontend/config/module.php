<?php
return [
    'modules' => [
        'frontend' => [
            'class' => 'app\modules\frontend\Module',
        ],
    ],
    'components' => [
        'urlManager' => [
            'rules' => [
                '/' => '/frontend/site/index',
                'sitemap.xml' => '/frontend/site/sitemap',
            ],
        ],
    ],
];