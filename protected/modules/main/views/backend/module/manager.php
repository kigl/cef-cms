<?php 
use app\modules\main\widgets\backend\grid\GridView;
use yii\widgets\Pjax;
?>

<?php 
$this->params['breadcrumbs'] = [
	['label' => 'Модули']
];
?>

<?php Pjax::begin();?>
	<?php echo GridView::widget([
							'dataProvider' => $dataProvider,
							'buttons' => ['create'],
							'columns' => [
								'id',
								'name',
								'description',
								[
								'headerOptions' => ['style' => 'width: 50px'],
								'class' => 'yii\grid\ActionColumn',
								'template' => '{update}  {delete}',
								],
							],
							]
						);
	?>
<?php Pjax::end();?>