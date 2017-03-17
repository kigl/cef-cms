<?php
return [
	'modules' => [
		'backend' => [
			'modules' => [
				'page' => [
					'class' => 'kigl\cef\module\page\Module',
					'controllerNamespace' => 'kigl\cef\module\page\controllers\backend',
					'viewPath' => '@kigl/cef/module/page/views/backend',
                    'controllerMap' => [
                        'default' => 'kigl\cef\module\backend\controllers\DefaultController',
                    ],
				],
			],
		],
		'page' => [
			'class' => 'kigl\cef\module\page\Module',
			'controllerNamespace' => 'kigl\cef\module\page\controllers\frontend',
			'viewPath' => '@kigl/ceg/module/page/views/frontend',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'page' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@kigl/cef/module/page/messages',
						'fileMap' => [
							'page' => 'module.php',
						],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
				['class' => 'kigl\cef\module\page\components\PageRule'],
			],
		],

        'sitemap' => [
            'models' => [
                \kigl\cef\module\page\models\Page::class,
            ],
        ],
	],
];