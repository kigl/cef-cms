<?php
use yii\helpers\Html;

$this->breadcrumbs = [
	['label' => 'Пользователи', 'url' => ['manager']],
	['label' => 'Изменения пароля'],
];

$this->toolbar = [
	['label' => '<button form="form" class="btn btn-success btn-sm">'. Yii::t('main', 'button save') .'</button>'],
];
?>
<div class="well well-sm">
	<div class="row">
		<div class="col-md-6">
			<?php echo HtmL::beginForm('', 'post', ['id' => 'form']);?>
			<?php echo Html::errorSummary($model, ['class' => 'alert alert-danger']);?>
			<div class="form-group">
				<?php echo Html::activeLabel($model, 'password');?>
				<?php echo Html::passwordInput('User[password]', '', ['class' => 'form-control']);?>
			</div>
			<div class="form-group">
				<?php echo Html::activeLabel($model, 'password_repeat');?>
				<?php echo Html::passwordInput('User[password_repeat]', '', ['class' => 'form-control']);?>
			</div>
			<?php echo Html::endForm();?>
		</div>
	</div>
</div>