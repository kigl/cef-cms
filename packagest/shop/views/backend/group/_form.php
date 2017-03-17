<?
use kigl\cef\module\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data['model']);?>

<div class="row">
    <div class="col-md-12"><?= $form->field($data['model'], 'name')?></div>
</div>

<?= $form->field($data['model'], 'description')->textarea();?>

<?= $form->field($data['model'], 'content')->widget(\vova07\imperavi\Widget::className(), [
    'settings' => [
        'minHeight' => 400,
    ],
]);?>

<legend><?= Yii::t('app', 'Form legend seo');?></legend>

<?= $form->field($data['model'], 'alias');?>

<?= $form->field($data['model'], 'meta_title');?>

<?= $form->field($data['model'], 'meta_description')->textarea();?>

<?php ActiveForm::end();?>
