<?php
use yii\jui\DatePicker;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\helpers\Html;
use vova07\imperavi\Widget;
use app\modules\main\widgets\backend\ActiveForm;
use app\modules\informationsystem\widgets\backend\fileInForm\Widget as FileInForm;
use app\modules\informationsystem\widgets\backend\tagEditor\TagEditor;
use app\modules\informationsystem\models\Informationsystem as System;

$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<div class="row">
	<div class="col-md-4">
		<?= $form->field($model, 'item_type')->radioList($model->getTypeList());?>
	</div>
	<div class="col-md-8">
		<?= $form->field($model, 'name');?>
	</div>
</div>

<div class="row">
	<div class="col-md-6">
		<?= $form->field($model, 'status')->dropDownList($model->getStatusList());?>
	</div>
	<div class="col-md-6">
		<?= $form->field($model, 'sort');?>
	</div>
</div>

<div class="row">
	<div class="col-md-4">
		<?= FileInForm::widget([
				'model' => $model,
				'deleteKey' => 'deleteImage',
				'behaviorName' => 'imageUpload',
				]);
		?>
		<?= $form->field($model, 'image')->fileInput();?>
	</div>
	<div class="col-md-4">
		<?= FileInForm::widget([
				'model' => $model,
				'deleteKey' => 'deleteVideo',
				'behaviorName' => 'videoUpload',
				]);
		?>
		<?= $form->field($model, 'video')->fileInput();?>
	</div>
	<div class="col-md-4">
		<?= FileInForm::widget([
				'model' => $model,
				'deleteKey' => 'deleteFile',
				'behaviorName' => 'fileUpload',
				]);
		?>
		<?= $form->field($model, 'file')->fileInput();?>
	</div>
</div>

<?= $form->field($model, 'description');?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
		'settings' => [
			'lang' => 'ru',
			'minHeight' => 400,
		],
]);?>

<?= $form->field($model, 'editorTag')->widget(TagEditor::className(), []);?>

<?php ActiveForm::end();?>