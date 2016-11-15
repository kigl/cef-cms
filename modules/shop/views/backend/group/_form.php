<?
use app\modules\admin\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<div class="row">
    <div class="col-md-4"><?= $form->field($model, 'name')?></div>
    <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList($model->getStatusList())?></div>
    <div class="col-md-4"><?= $form->field($model, 'sort')?></div>
</div>

<?= $form->field($model, 'description')->textarea();?>

<?= $form->field($model, 'content')->widget(\vova07\imperavi\Widget::className(), [
    'settings' => [
        'minHeight' => 400,
    ],
]);?>

<?= $form->field($model, 'alias');?>

<?= $form->field($model, 'meta_title');?>

<?= $form->field($model, 'meta_description')->textarea();?>

<?php ActiveForm::end();?>
