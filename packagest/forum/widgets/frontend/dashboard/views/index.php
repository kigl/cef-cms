<?php
use yii\helpers\Html;
use yii\grid\GridView;
?>

<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'layout' => "{items}",
		'tableOptions' => ['class' => 'table sfsd '],
		'columns' => [
			[
				'format' => 'raw',
				'views' => function($data) {
					return Html::a($data->name, ['topic/manager', 'parentId' => $data->id]);
				},
			],
			'countTopic',
		],
]);?>
