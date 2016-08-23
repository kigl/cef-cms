<?php 
use app\modules\main\widgets\grid\GridView;
use yii\widgets\Pjax;
?>

<?php 
$this->breadcrumbs = [
	['label' => 'Модули']
];
$this->toolbar = [
	['label' => '<i class="glyphicon glyphicon-plus"></i> '. Yii::t('main', 'button add'), 'url' => ['create']],
];
?>

<?php Pjax::begin();?>
	<?php echo GridView::widget([
							'dataProvider' => $dataProvider,
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