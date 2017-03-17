<?php
use kigl\cef\module\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?=$form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'type')->dropDownList($model->getListType());?>

<?= $form->field($model, 'required')->checkbox();?>

<?php ActiveForm::end();?>