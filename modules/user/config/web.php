<?php
return [
	'modules' => [
		'backend' =>[
			'modules' => [
				'user' => [
					'class' => 'app\modules\user\Module',
					'controllerNamespace' => 'app\modules\user\controllers\backend',
					'viewPath' => '@app/modules/user/views/backend',
				],
			],
		],
		
		'user' => [
			'class' => 'app\modules\user\Module',
			'controllerNamespace' => 'app\modules\user\controllers\frontend',
			'viewPath' => '@app/modules/user/views/frontend',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'user' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/user/messages',
					'fileMap' => [
						'user' => 'module.php',
					],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
			    'login' => '/user/default/login',
                'registration' => '/user/default/registration',
                'personal' => '/user/default/personal',
                'logout' => '/user/default/logout',
			],
		],
	],
];