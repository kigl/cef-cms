<?php
use app\modules\infosystem\Module;

return [
	'modules' => [
		'backend' => [
			'modules' => [
				'infosystem' => [
					'class' => Module::className(),
					'controllerNamespace' => 'app\modules\infosystem\controllers\backend',
					'viewPath' => '@app/modules/infosystem/views/backend',
				],
			],
		],
		'infosystem' => [
			'class' => Module::className(),
			'controllerNamespace' => 'app\modules\infosystem\controllers\frontend',
			'viewPath' => '@app/modules/infosystem/views/frontend',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'infosystem' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/infosystem/messages',
					'fileMap' => [
						'infosystem' => 'module.php',
					],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
				['class' => \app\modules\infosystem\components\UrlRule::class],
			],
		],
	],
];