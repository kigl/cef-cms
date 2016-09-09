<?php
return [
	'modules' => [
		'page' => [
			'class' => 'app\modules\page\Module',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'page*' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/page/messages',
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