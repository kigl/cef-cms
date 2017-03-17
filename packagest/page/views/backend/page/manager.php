<?php
use kigl\cef\module\page\Module;
use kigl\cef\module\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Pages'));
$this->setPageHeader(Module::t('Pages'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Pages')];

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