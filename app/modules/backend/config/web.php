<?php
return [
    'controllerMap' => [
        'elfinder' => [
            'class' => 'mihaildev\elfinder\Controller',
            'access' => ['@'],
            //глобальный доступ к фаил менеджеру @ - для авторизорованных , ? - для гостей , чтоб открыть всем
            'roots' => [
                [
                    'baseUrl' => '@web',
                    'basePath' => '@webroot',
                    'path' => '/',
                    'name' => 'Global'
                ],
            ],
        ],
    ],

	'modules' => [
		'backend' => [
			'class' => 'app\modules\backend\Module',
		],
        'gridview' =>  [
            'class' => 'kartik\grid\Module',
        ]
	],
];