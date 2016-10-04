<?php
use yii\bootstrap\NavBar;
use yii\bootstrap\Nav;
?>

<?php NavBar::begin();?>

<?= Nav::widget([
      'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
			
					['label' => Yii::t('user', 'Athenticate'), 'url' => ['/user/default/login'], 'visible' => Yii::$app->user->isGuest],
			
					['label' => Yii::t('user', 'Logout'), 'url' => ['/user/default/logout'], 'visible' => !Yii::$app->user->isGuest],
			
			]
]);?>

<?php
if (!Yii::$app->user->isGuest) {
	echo Nav::widget([
      'options' => ['class' => 'navbar-nav navbar-right'],
			'items' => [
				[
					'label' => Yii::t('user', 'Profile'),
					'url' => ['/user/default/profile', 'id' => Yii::$app->user->getId()]
				],
			],
	]);
}
?>

<?php NavBar::end(); ?>