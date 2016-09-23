<?php 
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\widgets\Pjax;
?>

<?php Pjax::begin();?>
	<?php $form = ActiveForm::begin([
		'enableClientValidation' => false,
		'fieldConfig' => [
			'template' => "{label}\n{input}\n",
		],
		'options' => ['data-pjax' => true],
	]);?>

	<?php echo $form->errorSummary($model, ['class' => 'alert alert-danger']);?>
	<?php echo $form->field($model, 'login');?>
	<?php echo $form->field($model, 'password')->passwordInput();?>
	<?php echo Html::submitButton('login', ['calss' => 'sendForm'])?>
	<?php $form->end();?>
<?php Pjax::end();?>