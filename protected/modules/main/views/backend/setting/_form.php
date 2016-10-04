<?php
use app\modules\main\widgets\backend\ActiveForm;
use app\modules\main\Module;
?>

<div class="row">
	<div class="col-md-12">
		<?php $form = ActiveForm::begin(['id' => 'form']);?>
		<?php echo $form->errorSummary($model,  ['class' => 'alert alert-danger']);?>
		<?php echo $form->field($model, 'type_id')->dropDownList($model->getFieldTypeList());?>
		<?php echo $form->field($model, 'module_id')->dropDownList(Module::getModuleList());?>
		<?php echo $form->field($model, 'name');?>
		<?php echo $form->field($model, 'label');?>
		<?php echo $form->field($model, 'value');?>
		<?php $form->end();?>
	</div>
</div>