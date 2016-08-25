<?php
use app\modules\main\widgets\grid\GridView;
use app\modules\user\models\User;

$this->breadcrumbs = [
	['label' => 'Пользователи'],
];
?>

<?php
echo GridView::widget([
		'dataProvider' => $dataProvider,
		'buttons' => ['create'],
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