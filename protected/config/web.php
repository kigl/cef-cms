<?php
$config = [
	'id' => 'basic',
	'basePath' => dirname(dirname(__FILE__)),
	'bootstrap' => ['log', 'setting'],
	'modules' => [
		'main' => [
			'class' => 'app\modules\main\Main',
		],
	],
	
	'defaultRoute' => 'site/index',

	'language' => 'ru',

	'components' => [
		'i18n'=>array(
			'translations' => array(
				'*' => array(
					'class'   => 'yii\i18n\PhpMessageSource',
					'basePath'=> '@app/modules/main/messages',
					'fileMap'   => array(
						'main'=> 'main.php',
					),
				)
			),
		),
		
		'formatter' => [
			'dateFormat' => 'dd-MM-yyyy',
		],

		'request' => [
			// !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
			'cookieValidationKey' => 'main',
		],

		'setting' => [
			'class' => 'app\modules\main\components\DbSetting',
		],

		/*'cache' => [
		'class' => 'yii\caching\FileCache',
		],*/

		'view' => [
			'class' => 'app\modules\main\components\View',
			'theme' => [
				'pathMap'  => [
					'@app/views' => ['@app/themes/basic'],
				],
				'basePath' => '@app/themes/basic',
				'baseUrl' => '@web/protected/themes/basic',
			],
		],

		'assetManager' => [
			'basePath' => '@webroot/public/assets',
			'baseUrl' => '@web/public/assets',
			'appendTimestamp' => false,
		],

		'user' => [
			'identityClass' => 'app\modules\user\models\User',
			'enableAutoLogin' => false,
			'loginUrl' => ['/user/frontend/user/login'],
		],

		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'defaultRoles' => ['guest'],
		],

		'errorHandler' => [
			//'errorAction' => 'site/error',
		],
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			// send all mails to a file by default. You have to set
			// 'useFileTransport' to false and configure a transport
			// for the mailer to send real emails.
			'useFileTransport' => true,
		],
		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				[
					'class' => 'yii\log\FileTarget',
					'levels' => ['error', 'warning'],
				],
			],
		],
		'db' =>  [
			'class' => 'yii\db\Connection',
			'dsn' => 'mysql:host=localhost;dbname=main2',
			'username' => 'root',
			'password' => '',
			'charset' => 'utf8',
		],

		'urlManager' => [
			'enablePrettyUrl' => true,
			'showScriptName' => false,
			'rules' => [
			],
		],

	],
];

if(YII_ENV_DEV){
	// configuration adjustments for 'dev' environment
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
	];

	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module',
	];
}

return $config;
