<?php
use yii\helpers\Url;
use yii\helpers\Html;
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
			[
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function ($data) {
					return Html::a(Html::encode($data->name), Url::to(['backend/manager/item', 'informationsystem_id' => $data->id]));
				}
			],
			[
				'label' => 'status',
				'attribute' => 'status',
				'value' => function($model, $key, $index, $column) {
						return $model->getStatus($model->status);
				} 
			],
			'update_time:date',
			'id',
			[
				'headerOptions' => ['style' => 'width: 50px'],
				'class' => 'yii\grid\ActionColumn',
				'template' => '{update}  {delete}',
				'buttons' => [
					'update' => function ($url, $model, $key) {
						return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['backend/update/system', 'id' => $model->id]);
					},
					'delete' => function ($url, $model, $key) {
						return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['backend/delete/system', 'id' => $model->id], ['date-method' => 'POST', 'data-confirm' => Yii::t('main', 'question on delete file')]); 	
					}
				],
			]
		],
]);?>