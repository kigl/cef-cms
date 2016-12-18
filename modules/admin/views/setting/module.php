<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>
<div class="well well-sm">
	<div class="row">
		<div class="col-md-8">
			<?php $form = ActiveForm::begin([
				'id' => 'form',
				'enableClientValidation' => false,
				]);?>
				<?php foreach ($model as $key => $setting) :?>
					<?php echo Html::hiddenInput('Setting' . "[$key][id]", $setting->id);?>
					<?php $type = $setting->getFieldType($setting->type_id);?>
					<?php if ($type == 'text') {?>
						<?php echo $form->field($setting, "[$key]views")->label($setting->label);?>
					<?php } else if ($type == 'checkbox') {?>
						<?php echo $form->field($setting, "[$key]views")->checkbox()->label($setting->label);?>
					<?php } else if ($type == 'textarea') {?>
						<?php echo $form->field($setting, "[$key]views")->label($setting->label)->textArea();?>
					<?php }?>
				<?php endforeach;?>
			<?php $form->end();?>
		</div>
	</div>
</div>


