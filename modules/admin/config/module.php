<?php
return [
	'modules' => [
		'admin' => [
			'class' => 'app\modules\admin\Module',
            /*'modules' => [
                'rbac' => [
                    'class' => 'dektrium\rbac\RbacWebModule',
                    'layout' => '@app/modules/admin/views/layouts/column_2.php',
                ],
            ],*/
		],
	],
	
	'components' => [
		'i18n' => [
			'translations' => [
				'admin' => [
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/admin/messages',
					'fileMap' => [
						'admin' => 'module.php',
					],
				],			
			],
		],
		'urlManager' => [
			'rules' => [
			    'admin' => '/admin/default/index',
			],
		],
	],
];