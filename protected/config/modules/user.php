<?php
return [
	'modules' => [
		'user' => [
			'class' => 'app\modules\user\Module',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'user*' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/user/messages',
				],			
			],
		],
		'urlManager' => [
			'rules' => [
			],
		],
	],
];