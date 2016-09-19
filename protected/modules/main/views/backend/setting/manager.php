<?php 
use app\modules\main\widgets\grid\GridView;
?>

<?php echo GridView::widget([
						'dataProvider' => $dataProvider,
						'buttons' => ['create'],
						'columns' => [
							'module_id',
							'name',
							'label',
							'value',
							'id',
							[
							'headerOptions' => ['style' => 'width: 50px'],
							'class' => 'yii\grid\ActionColumn',
							'template' => '{update}  {delete}',
							],
						],
						]
					);
?>
