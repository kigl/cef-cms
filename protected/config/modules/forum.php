<?php
return [
	'modules' => [
		'forum' => [
			'class' => 'app\modules\forum\Module',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'forum' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/forum/messages',
				],			
			],
		],
	],
];