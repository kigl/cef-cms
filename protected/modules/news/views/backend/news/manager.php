<?php
use yii\helpers\Html;
use app\modules\main\widgets\grid\GridView;
use yii\jui\DatePicker;
use app\modules\news\models\News;

$this->breadcrumbs = [
	['label' => 'Новости'],
];
?>

<?php echo GridView::widget([
	'dataProvider' => $dataProvider,
	'filterModel' => $searchModel,
	'buttons' => ['create'],
	'columns' => [
		'title',
		[
		'label' => 'status',
		'attribute' => 'status',
		'value'=> 
				function($data) {
					return News::getStatus($data->status);
				},
		'filter' => Html::activeDropDownList($searchModel, 'status', array_merge(['' => ''], News::getStatusList()), ['class' => 'form-control']),
		],
		[
			'label' => 'date',
			'attribute' => 'date',
			'format' => 'date',
			'headerOptions' => ['style' => 'width: 200px;'],
			'filter' => DatePicker::widget([
				'model' => $searchModel,
				'attribute' => 'date',
				'options' => ['class' => 'form-control'],
			]),
		],
		[
		'label' => 'id',
		'attribute' => 'id',
		],
    [
    'headerOptions' => ['style' => 'width: 50px'],
    'class' => 'yii\grid\ActionColumn',
    'template' => '{update} {delete}',
    ],
	],
]);?>