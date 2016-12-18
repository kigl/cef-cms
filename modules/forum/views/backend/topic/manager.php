<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\Pjax;
use app\modules\main\widgets\backend\grid\GridView;

?>

<?= GridView::widget([
	'dataProvider' => $topicDataProvider,
	'buttons' => [
		'create' => [
			'action' => Url::to(['create', 'parent_id' => $parent_id]),
		],
	],
	'columns' => [
		[
			'attribute' => 'name',
			'format' => 'raw',
			'views' => function($data) {
				return Html::a($data->name, Url::to(['manager', 'parent_id' => $data->id]	));
			},
		],
		[
			'attribute' => 'user_id',
			'views' => function($data) {
				return "{$data->author->surname} {$data->author->name}";
			},
		],
		'id',
		[
			'headerOptions' => ['style' => 'width: 50px'],
			'class' => 'yii\grid\ActionColumn',
			'template' => '{update}  {delete}',
		]
	],
]);?>

<div class="panel panel-default">
	<div class="panel-heading">Посты</div>
	<div class="panel-body">
		<?php Pjax::begin();?>
		<?= GridView::widget([
			'dataProvider' => $postDataProvider,
			'columns' => [
				[
					'attribute' => 'user_id',
					'views' => function($data) {
						return "{$data->author->surname} {$data->author->name}";
					},
				],
				'id',
				'content',
			[
				'headerOptions' => ['style' => 'width: 50px'],
				'class' => 'yii\grid\ActionColumn',
				'template' => '{delete}',
				'controller' => 'backend/post',
				/*
				'buttons' => [
					'update' => function ($url, $model, $key) {
						return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['backend/update/system', 'id' => $model->id]);
					},
					'delete' => function ($url, $model, $key) {
						return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['backend/delete/system', 'id' => $model->id], ['date-method' => 'POST', 'data-confirm' => Yii::t('main', 'question on delete file')]); 	
					}
					*/
				],
			],
		]);?>
		<?php Pjax::end();?>
	</div>
</div>