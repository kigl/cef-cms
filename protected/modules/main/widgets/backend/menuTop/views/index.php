<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
?>

<?php 
NavBar::begin([
		'options' => ['class' => 'navbar navbar-inverse bg-theme'],
    'innerContainerOptions' => ['class' => 'container-fluid'],
	]);

echo Nav::widget([
		'options' => ['class' => 'navbar-nav'],
		'encodeLabels' => false,
		'items' => [
			['label' => '<i class="glyphicon glyphicon-cog"></i> Системные', 'items' => [
					['label' => 'Менеджер настроек', 'url' => ['/main/backend/setting/manager']],
				],
			],
		],
	]);
	
echo Nav::widget([
	'options' => ['class' => 'navbar-nav pull-right'],
	'encodeLabels' => false,
	'items' => [
		['label' => '<i class="glyphicon glyphicon-user"></i> '. Yii::$app->user->identity->login, 'url' => ['/user/backend/default/update', 'id' => Yii::$app->user->identity->id]],
		['label' => Yii::t('user', 'Logout'), 'url' => ['/user/default/logout']],
	],
]);

NavBar::end()
?>