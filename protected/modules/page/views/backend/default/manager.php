<?php
use app\modules\main\widgets\backend\grid\GridView;

use yii\helpers\Url;
?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'buttons' => ['create'],
	'columns' => [
		'name',
		'id',
		[
			'headerOptions' => ['style' => 'width: 50px'],
			'class' => 'yii\grid\ActionColumn',
			'template' => '{update}  {delete}',
		]
	],
]);?>