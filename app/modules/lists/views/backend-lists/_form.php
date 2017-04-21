<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data['model'])?>

<?= $form->field($data['model'], 'name');?>

<?= $form->field($data['model'], 'description');?>

<?php ActiveForm::end();?>
