<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
use app\modules\main\widgets\adminPanel\Asset;

Asset::register($this);

NavBar::begin([
		'options' => ['class' => 'navbar navbar-default'],
	]);
	
echo Nav::widget([
	'options' => ['class' => 'navbar-nav'],
	'encodeLabels' => false,
	'items' => [
		['label' => '<i class="glyphicon glyphicon-file"></i> Модули', 'items' => $module,],
	],
]);

echo Nav::widget([
		'options' => ['class' => 'navbar-nav'],
		'encodeLabels' => false,
		'items' => [
			['label' => '<i class="glyphicon glyphicon-cog"></i> Системные', 'items' => $system],
		],
	]);
	
echo Nav::widget([
	'options' => ['class' => 'navbar-nav pull-right'],
	'encodeLabels' => false,
	'items' => [
		['label' => '<i class="glyphicon glyphicon-user"></i> '. Yii::$app->user->identity->login, 'url' => ['/user/backend/default/update', 'id' => Yii::$app->user->identity->id]],
		['label' => Yii::t('main', 'button exit'), 'url' => ['/user/default/logout']],
	],
]);

NavBar::end()
?>