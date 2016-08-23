<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
	'enableClientValidation' => false,
	'fieldConfig' => [
		'template' => "{label}\n{input}\n",
	],
]);?>

<?php echo $form->errorSummary($model, ['class' => 'alert alert-danger']);?>
<?php echo $form->field($model, 'login');?>
<?php echo $form->field($model, 'password')->passwordInput();?>
<?php echo Html::submitButton('login')?>
<?php $form->end();?>