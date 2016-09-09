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
				'informationsystem*' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/informationsystem/messages',
				],			
			],
		],
		'urlManager' => [
			'rules' => [
				['class' => 'app\modules\informationsystem\components\InformationsystemRule'],
				//'system' - показываются все элементы
				//'/system/group' - показываются элементы из группы
				//'system/item/id' - показываем элемент
				//'news/<group_id>' => 'informationsystem/frontend/news/group',
				//'news/item/<id>' => 'informationsystem/frontend/news/item',
				//'news' => 'informationsystem/frontend/news/system',
			],
		],
	],
];