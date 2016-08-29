<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Modal;
use app\modules\main\widgets\activeForm\ActiveForm;
use vova07\imperavi\Widget;
?>

<?php $form = ActiveForm::begin();?>
	<?php echo $form->errorSummary($model);?>
	
	<div class="row">
		<div class="col-md-6">
			<?php if ($model->imageExist()) :?>
				<div class="img-thumbnail">
					<div>
						<label class="pull-right">Удалить
							<input type="checkbox" name="deleteFile"/>
						</label>
					</div>
					<?php Modal::begin(['toggleButton' => ['label' => $model->image]])?>
						<?php echo Html::img($model->getFileUrl());?>
					<?php Modal::end();?>
				</div>
			<?php endif;?>
			<?php echo $form->field($model, 'image')->fileInput();?>
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
	
	<?php echo $form->field($model, 'seo_title');?>
	
	<?php echo $form->field($model, 'seo_description');?>

	
<?php ActiveForm::end();?>