<?php
use yii\helpers\Url;
use app\modules\main\widgets\grid\GridView;
?>

<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'buttons' => [
			'create' => [
				'action' => Url::to(['backend/create/system']),
			]
		],
		'columns' => [
			'name',
			'status',
			'update_time:date',
			'id',
			[
				'headerOptions' => ['style' => 'width: 50px'],
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}  {delete}',
			]
		],
]);?>