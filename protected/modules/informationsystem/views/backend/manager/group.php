<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\widgets\grid\GridView;
?>

<?php echo GridView::widget([
		'dataProvider' => $dataProvider,
		'buttons' => [
			'create' => [
				'action' => [
					'backend/create/group',
					'informationsystem_id' => Yii::$app->request->getQueryParam('informationsystem_id'),
					'group_id' => Yii::$app->request->getQueryParam('group_id') == null ? 0 : Yii::$app->request->getQueryParam('group_id'),
				]
			],
		],
		'columns' => [
			[
				'attribute' => 'name',
				'format' => 'raw',
				'value' => function ($data) {
					return Html::a($data->name, [
							'backend/manager/group',
							'group_id' => $data->id,
							'informationsystem_id' => Yii::$app->request->getQueryParam('informationsystem_id'),		
					]);
				}
			],
		],
]);?>