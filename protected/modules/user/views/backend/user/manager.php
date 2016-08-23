<?php
use app\modules\main\widgets\grid\GridView;
use app\modules\user\models\User;

$this->breadcrumbs = [
	['label' => 'Пользователи'],
];

$this->toolbar = [
	['label' => '<i class="glyphicon glyphicon-plus"></i> ' . Yii::t('main', 'button add'), 'url' => ['create']],
];
?>

<?php
echo GridView::widget([
		'dataProvider' => $dataProvider,
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