<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

//$this->setTitle('Регистрация');
?>

<?php $form = ActiveForm::begin();?>
	<?php echo $form->field($model, 'login');?>
	<?php echo $form->field($model, 'email');?>
	<?php echo $form->field($model, 'password')->passwordInput();?>
	<?php echo $form->field($model, 'passwordConfirm')->passwordInput();?>
	<?php echo Html::submitButton('Регистрация');?>
<?php $form->end();?>