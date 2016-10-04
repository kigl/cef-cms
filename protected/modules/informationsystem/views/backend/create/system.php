<?php
use app\modules\main\widgets\backend\ActiveForm;
use vova07\imperavi\Widget;
use app\modules\main\widgets\backend\imageUpload\Widget as ImageUpload;
?>

<?php $form = ActiveForm::begin();?>
	<?php echo $form->errorSummary($model);?>
	
	<?= $form->field($model, 'id');?>
	
	<div class="row">
		<div class="col-md-6">
			<?= ImageUpload::widget(['model' => $model, 'formInstance' => $form, 'attribute' => 'image']);?>
		</div>
		
		<div class="col-md-6">
			<?php echo $form->field($model, 'status')->dropDownList($model->getStatusList());?>
		</div>
	</div>
	
	<?php echo $form->field($model, 'name');?>
	
	<?php echo $form->field($model, 'description')->textArea();?>
	
	<?php echo $form->field($model, 'content')->widget(Widget::className(), [
			'settings' => [
				'lang' => 'ru',
				'minHeight' => 400,
			],
	]);?>
	
	<?= $form->field($model, 'items_per_page');?>

	
<?php ActiveForm::end();?>