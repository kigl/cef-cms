<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\widgets\backend\grid\GridView;
use app\modules\informationsystem\models\InformationsystemItem as Item;

$this->params['breadcrumbs'] = $breadcrumbs;

$this->params['actionBar'] = [
	[
		'label' => '<i class="glyphicon glyphicon-plus"></i>',
		'url' => ['offers/create', 'group_id' => $group_id],
		//'visible' => !Yii::$app->user->isGuest,
	],
];
?>

<?= GridView::widget([
			'dataProvider' => $dataProvider,
			'options' => ['class' => 'bg-content'],
			'columns' => [
				[
					'attribute' => 'item_type',
					'label' => false,
					'format' => 'raw',
					'headerOptions' => ['style' => 'width: 25px'],
					'value' => function ($data) {
						return $data->item_type == Item::TYPE_GROUP ? 
							Html::tag('i', '', ['class' => 'fa fa-folder']) :
							Html::tag('i', '', ['class' => 'fa fa-file-text-o']);
					}
				],
				[
					'attribute' => 'name',
					'format' => 'raw',
					'value' => function ($data) {
						return $data->item_type == Item::TYPE_GROUP ?
								Html::a($data->name, [
									'manager',
									'group_id' => $data->id,
									]) 
									: $data->name;
					},
				],
				'create_time:date',
				'id',
				[
					'class' => 'yii\grid\ActionColumn',
					'template' => '{view}',
					'headerOptions' => ['style' => 'width: 70px'],
					'buttons' => [
						'view' => function ($url, $model, $key) {
							return $model->item_type == Item::TYPE_ITEM? 
											Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['view', 'id' => $model->id], ['class' => 'view-item']): null;
						},
					],
				]
			],
]);?>