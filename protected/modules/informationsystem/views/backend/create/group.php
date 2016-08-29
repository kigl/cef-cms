<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\widgets\activeForm\ActiveForm;
use vova07\imperavi\Widget;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'informationsystem_id')->hiddenInput(['value' => Yii::$app->request->getQueryParam('informationsystem_id')])->label(false);?>

<?= $form->field($model, 'informationsystem_item_group_id')->hiddenInput(['value' => null]);?>

<?= $form->field($model, 'informationsystem_parent_group_id')->hiddenInput(['value' => Yii::$app->request->getQueryParam('group_id')]);?>

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