<?php
use app\modules\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'url');?>

<?= $form->field($model, 'visible');?>

<?= $form->field($model, 'class');?>

<?= $form->field($model, 'icon_class');?>

<?= $form->field($model, 'position');?>

<?php ActiveForm::end();?>
