<?php
return [
	'modules' => [
		'backend' => [
			'modules' => [
				'page' => [
					'class' => 'app\modules\page\Module',
					'controllerNamespace' => 'app\modules\page\controllers\backend',
					'viewPath' => '@app/modules/page/views/backend',
				],
			],
		],
		'page' => [
			'class' => 'app\modules\page\Module',
			'controllerNamespace' => 'app\modules\page\controllers\frontend',
			'viewPath' => '@app/modules/page/views/frontend',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'page*' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/page/messages',
						'fileMap' => [
							'page' => 'module.php',
						],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
				['class' => 'app\modules\page\components\PageRule'],
			],
		],
	],
];