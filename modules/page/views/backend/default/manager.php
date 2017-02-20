<?php
use app\modules\backend\widgets\grid\GridView;

use yii\helpers\Url;
?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'buttons' => ['create' => ['element']],
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