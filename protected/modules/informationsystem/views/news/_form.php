<?php
use app\modules\main\widgets\backend\ActiveForm;
use vova07\imperavi\Widget;
use app\modules\informationsystem\models\InformationsystemItem as Item;
?>

<?php $form = ActiveForm::begin();?>
<?= $form->errorSummary($model);?>
<?= $form->field($model, 'informationsystem_id')->hiddenInput(['value' => Yii::$app->controller->systemId])->label(false);?>
<?= $form->field($model, 'parent_id')->hiddenInput(['value' => $group_id])->label(false);?>
<?= $form->field($model, 'item_type')->hiddenInput(['value' => Item::TYPE_ITEM])->label(false);?>
<?= $form->field($model, 'status')->hiddenInput(['value' => Item::STATUS_ACTIVE])->label(false);?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
		'settings' => [
			'lang' => 'ru',
			'minHeight' => 400,
		],
]);?>

<?php ActiveForm::end();?>