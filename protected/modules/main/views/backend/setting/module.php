<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->breadcrumbs = [
	['label' => 'Настройки', 'url' => ['manager']],
	['label' => 'Настройки модуля'],
];

$this->pageHeader = 'Настройки модуля: ' . $module->name;

$this->toolbar = [
	['label' => '<button form="form" class="btn btn-success btn-sm">'.Yii::t('main', 'button save').'</button>'],
];
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
						<?php echo $form->field($setting, "[$key]value")->label($setting->label);?>
					<?php } else if ($type == 'checkbox') {?>
						<?php echo $form->field($setting, "[$key]value")->checkbox()->label($setting->label);?>
					<?php } else if ($type == 'textarea') {?>
						<?php echo $form->field($setting, "[$key]value")->label($setting->label)->textArea();?>
					<?php }?>
				<?php endforeach;?>
			<?php $form->end();?>
		</div>
	</div>
</div>


