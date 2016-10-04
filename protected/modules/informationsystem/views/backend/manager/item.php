<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\widgets\backend\grid\GridView;
use app\modules\informationsystem\models\InformationsystemSystem as System;
use app\modules\informationsystem\models\InformationsystemItem as Item;

$this->params['breadcrumbs'] = $breadcrumbs;
$this->params['toolbar'] = [
	[
		'label' => '<i class="glyphicon glyphicon-tags"></i> ' . Yii::t($this->context->module->id, 'Tag toolbar'),
		'url' =>  ['backend/manager/tag', 'informationsystem_id' => $informationsystem_id],
	]
];
?>

<?php echo GridView::widget([
	'filterModel' => $searchModel,
	'dataProvider' => $dataProvider,
	'buttons' => [
		'create' => [
			'action' => Url::to([
				'backend/create/item',
				'informationsystem_id' => Yii::$app->request->getQueryParam('informationsystem_id'),
				'group_id' => Yii::$app->request->getQueryParam('group_id'),
			]),
		],
	],
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
							'backend/manager/item',
							'informationsystem_id' => $data->informationsystem_id,
							'group_id' => $data->id,
							]) 
							: $data->name . "&nbsp;&nbsp;&nbsp;<span class='small'>(" . Yii::$app->formatter->asDate($data->create_time) . ")</span>";
			},
		],
		'id',
		[
			'headerOptions' => ['style' => 'width: 70px'],
			'class' => 'yii\grid\ActionColumn',
			'buttons' => [
				'view' => function ($url, $model, $key) {
					return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['view', 'id' => $model->id], ['class' => 'view-item']);
				},
				'update' => function ($url, $model, $key) {
					return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
							'backend/update/item',
							'id' => $model->id
						]
					);
				},
				'delete' => function ($url, $model, $key) {
					return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
							'backend/delete/item',
							'id' => $model->id],
						['date-method' => 'POST', 'data-confirm' => Yii::t('main', 'question on delete file')]
					); 	
				}
			],
		]
	],
]);?>