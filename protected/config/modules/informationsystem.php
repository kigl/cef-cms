<?php
return [
	'modules' => [
		'informationsystem' => [
			'class' => 'app\modules\informationsystem\Module',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'informationsystem' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/informationsystem/messages',
				],			
			],
		],
		'urlManager' => [
			'rules' => [
				['class' => 'app\modules\informationsystem\components\InformationsystemRule'],
			],
		],
	],
];