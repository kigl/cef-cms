<?php
use kigl\cef\module\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data['model']);?>

<?= $form->field($data['model'], 'name');?>

<?= $form->field($data['model'], 'description');?>

<?= $form->field($data['model'], 'sorting');?>

<?= $form->field($data['model'], 'type')->dropDownList($data['model']->getListFieldType());?>

<?= $form->field($data['model'], 'required')->checkbox();?>

<?php ActiveForm::end();?>
