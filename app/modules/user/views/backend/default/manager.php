<?php
use app\modules\admin\widgets\grid\GridView;
use app\modules\user\models\User;
?>

<?php
echo GridView::widget([
		'dataProvider' => $dataProvider,
		'buttons' => ['create' => ['item']],
		'columns' => [
			'login',
			[
				'attribute' => 'status',
				'value' =>
				function($data)	{
					return User::getStatus($data->status);
				},
			],
			'email',
			'id',
			[
				'headerOptions' => ['style' => 'width: 50px'],
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}  {delete}',
			]
		],
	]);
?>