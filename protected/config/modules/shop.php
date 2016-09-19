<?php
return [
	'modules' => [
		'shop' => [
			'class' => 'app\modules\shop\Module',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'shop' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath' => '@app/modules/shop/messages',
				],
			],
		],
	],
];