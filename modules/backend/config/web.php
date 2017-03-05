<?php
return [
	'modules' => [
		'backend' => [
			'class' => 'app\modules\backend\Module',
            'layout' => '@app/modules/backend/views/layouts/column_2',
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'backend' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/backend/messages',
					'fileMap' => [
						'backend' => 'module.php',
					],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
			    'backend' => '/backend/default/index',
			],
		],
	],
];