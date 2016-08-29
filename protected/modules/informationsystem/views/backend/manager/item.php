<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\widgets\grid\GridView;
?>

<?php echo GridView::widget([
	'dataProvider' => $dataProvider,
	'buttons' => [
		'create' => [
			'action' => Url::to(['backend/create/item', 'informationsystem_id' => Yii::$app->request->getQueryParam('informationsystem_id')]),
		],
	],
	'columns' => [
		'name',
	],
]);?>