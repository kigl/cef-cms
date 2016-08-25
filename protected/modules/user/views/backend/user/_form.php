<?php
use app\modules\main\widgets\activeForm\ActiveForm;
use app\modules\user\models\User;
?>

<?php $form = ActiveForm::begin(['id' => 'form']);?>

<ul class="nav nav-tabs">
	<li class="active">
		<a href="#main" data-toggle="tab">
			Основные данные
		</a>
	</li>
	<li>
		<a href="#profile" data-toggle="tab">
			Профиль
		</a>
	</li>
</ul>

<div class="tab-content well well-sm">
	<div class="tab-pane active" id="main">
		<?php echo $form->errorSummary($model, ['class' => 'alert alert-danger']);?>
		<?php echo $form->field($model, 'login');?>
		<?php echo $form->field($model, 'status')->dropDownList(User::getStatusList());?>
		<?php echo $form->field($model, 'email');?>
		<?php if ($model->scenario == 'insert') :?>
			<?php echo $form->field($model, 'password')->passwordInput();?>
			<?php echo $form->field($model, 'passwordConfirm')->passwordInput();?>
		<?php endif;?>
	</div>
	<div class="tab-pane" id="profile">
		<?php echo $form->field($model, 'surname');?>
		<?php echo $form->field($model, 'name');?>
		<?php echo $form->field($model, 'lastname');?>
	</div>
</div>
<?php $form->end();?>