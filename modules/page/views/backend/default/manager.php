<?php
use app\modules\backend\widgets\grid\GridView;

$this->setPageHeader(Yii::t('app', 'Manager: {data}', ['data' => 'страниц']));
?>

<?= GridView::widget([
	'dataProvider' => $dataProvider,
	'buttons' => ['create' => ['item']],
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