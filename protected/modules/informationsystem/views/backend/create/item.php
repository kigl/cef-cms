<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\widgets\activeForm\ActiveForm;
use vova07\imperavi\Widget;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'informationsystem_id')->hiddenInput()->label(false);?>

<?= $form->field($model, 'informationsystem_group_id');?>

<?= $form->field($model, 'name');?>

<div class="row">
	<div class="col-md-4">
		<?= $form->field($model, 'image');?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'status');?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'sort');?>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<?= $form->field($model, 'date');?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'date_start');?>
	</div>
	<div class="col-md-4">
		<?= $form->field($model, 'date_end');?>
	</div>
</div>

<?= $form->field($model, 'description');?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
		'settings' => [
			'lang' => 'ru',
			'minHeight' => 400,
		],
]);?>

<?= $form->field($model, 'seo_title');?>

<?= $form->field($model, 'seo_description');?>

<?php ActiveForm::end();?>