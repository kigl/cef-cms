<?php
use app\modules\main\widgets\ActiveForm;
?>

<div class="row">
	<div class="col-md-8">
		<?php $form = ActiveForm::begin(['id' => 'form']);?>
		<?php echo $form->errorSummary($model,  ['class' => 'alert alert-danger']);?>
		<?php echo $form->field($model, 'id');?>
		<?php echo $form->field($model, 'name');?>
		<?php echo $form->field($model, 'description')->textArea();?>
		<?php $form->end();?>
	</div>
</div>