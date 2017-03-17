<?php
use kigl\cef\module\infosystem\Module;

return [
	'modules' => [
		'backend' => [
			'modules' => [
				'infosystem' => [
					'class' => Module::className(),
					'controllerNamespace' => 'kigl\cef\module\infosystem\controllers\backend',
					'viewPath' => '@kigl/cef/module/infosystem/views/backend',
                    'controllerMap' => [
                        'default' => 'kigl\cef\module\backend\controllers\DefaultController',
                    ],
				],
			],
		],
		'infosystem' => [
			'class' => Module::className(),
			'controllerNamespace' => 'kigl\cef\module\infosystem\controllers\frontend',
			'viewPath' => '@kigl/cef/module/infosystem/views/frontend',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'infosystem' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@kigl/cef/module/infosystem/messages',
					'fileMap' => [
						'infosystem' => 'module.php',
					],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
				['class' => \kigl\cef\module\infosystem\components\UrlRule::class],
			],
		],
	],
];