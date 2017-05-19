<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<?= $form->field($model, 'id');?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'version');?>

<?php ActiveForm::end(); ?>
