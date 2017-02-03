<?php
use app\modules\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data['model']);?>

<?= $form->field($data['model'], 'name');?>

<?= $form->field($data['model'], 'url');?>

<?= $form->field($data['model'], 'visible')->dropDownList($data['model']->getStatusVisibleList());?>

<?= $form->field($data['model'], 'class');?>

<?= $form->field($data['model'], 'icon_class');?>

<?= $form->field($data['model'], 'position');?>

<?php ActiveForm::end();?>
