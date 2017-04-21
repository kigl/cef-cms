<?php
use app\modules\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data['model']);?>

<?= $form->field($data['model'], 'name');?>

<?= $form->field($data['model'], 'description');?>

<?= $form->field($data['model'], 'sorting');?>

<?php ActiveForm::end();?>
