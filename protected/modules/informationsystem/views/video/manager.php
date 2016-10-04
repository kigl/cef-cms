<?php
use yii\widgets\ListView;

$this->params['breadcrumbs'] = $breadcrumbs;

$this->params['actionBar'] = [
	[
		'label' => '<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('main', 'Button create'),
		'url' => ['video/create', 'group_id' => $group_id],
		'visible' => !Yii::$app->user->isGuest,
	],
];
?>

<div class="row invormationsystem-list">
	<?= ListView::widget([
				'dataProvider' => $dataProvider,
				'itemView' => '_item',
				'layout' => "{summary}\n{items}\n<div class='col-md-12 text-center'>{pager}</div>",
	]);?>
</div>