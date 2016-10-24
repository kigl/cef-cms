<?php
use app\modules\informationsystem\Module;

return [
	'modules' => [
		'admin' => [
			'modules' => [
				'informationsystem' => [
					'class' => Module::className(),
					'controllerNamespace' => 'app\modules\informationsystem\controllers\backend',
					'viewPath' => '@app/modules/informationsystem/views/backend',
				],
			],
		],
		
		'informationsystem' => [
			'class' => Module::className(),
			'controllerNamespace' => 'app\modules\informationsystem\controllers\frontend',
			'viewPath' => '@app/modules/informationsystem/views/frontend',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'informationsystem' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/informationsystem/messages',
					'fileMap' => [
						'informationsystem' => 'module.php',
					],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
			],
		],
	],
];