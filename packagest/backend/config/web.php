<?php
return [
	'modules' => [
		'backend' => [
			'class' => 'kigl\cef\module\backend\Module',
            'layout' => '@kigl/cef/module/backend/views/layouts/column_2',
		],
        'gridview' =>  [
            'class' => 'kartik\grid\Module',
        ]
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'backend' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@kigl/cef/module/backend/messages',
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