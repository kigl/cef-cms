<?php
use yii\jui\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\Html;
use app\modules\main\widgets\ActiveForm;
use app\modules\informationsystem\models\Informationsystem as System;
use vova07\imperavi\Widget;

$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<div class="row">
	<div class="col-md-4">
		<?= $form->field($model, 'item_type')->radioList($model->getTypeList());?>
	</div>
	<div class="col-md-8">
		<?= $form->field($model, 'name');?>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<?php if ($model->imageExist()) :?>
			<div class="img-thumbnail">
				<div>
					<label class="pull-right">Удалить
						<input type="checkbox" name="deleteFile"/>
					</label>
				</div>
				<?= Html::a($model->image, $model->getFileUrl(), ['target' => '_blanck']);?>
			</div>
		<?php endif;?>
		<?php echo $form->field($model, 'image')->fileInput();?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'status')->dropDownList($model->getStatusList());?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'sort');?>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<?= $form->field($model, 'date')->widget(DatePicker::className(), ['options' => ['class' => 'form-control']]);?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'date_start')->widget(DatePicker::className(), ['options' => ['class' => 'form-control']]);?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'date_end')->widget(DatePicker::className(), ['options' => ['class' => 'form-control']]);?>
	</div>
</div>

<?= $form->field($model, 'description');?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
		'settings' => [
			'lang' => 'ru',
			'minHeight' => 400,
		],
]);?>

<?= $form->field($model, 'alias');?>

<?= $form->field($model, 'meta_title');?>

<?= $form->field($model, 'meta_description');?>

<?php ActiveForm::end();?>