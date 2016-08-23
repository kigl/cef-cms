<?php
return [
	'modules' => [
		'user' => [
			'class' => 'app\modules\user\User',
			'modules' => [
				'rbac' => [
					'class' => 'app\modules\user\modules\rbac\Rbac',
					],
			],
		],
	],
	
	'components' => [
		'urlManager' => [
			'rules' => [
				'login' => '/user/frontend/user/login', 
			],
		],
	],
];