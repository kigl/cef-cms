<?php
use yii\grid\GridView;
use yii\helpers\Html;

$this->params['breadcrumbs'] = $breadcrumbs;

$this->params['actionBar'] = [
	[
		'label' => '<i class="glyphicon glyphicon-plus"></i>',
		'url' => ['create', 'parentId' => $parentId],
	],
];
?>

<div class="bg-content">
	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'tableOptions' => ['class' => 'table table-striped table-condensed'],
		'columns' => [
			[
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function($data) {
					$view = '';
					$view.= Html::tag('div', Html::a($data->name, ['view', 'id' => $data->id, 'view_counter' => 1]));
					$view.= Html::tag('span', "{$data->author->surname} {$data->author->name}", ['class' => 'small margin-right-10']);
					$view.= Html::tag('span', Yii::$app->formatter->asDatetime($data->create_time), ['class' => 'small']);
					return $view;
				}
			],
			'countPost',
			'counter',
		],
	]);?>
</div>