<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data['model']); ?>

<?= $form->field($data['model'], 'short_name'); ?>
<?= $form->field($data['model'], 'name'); ?>
<?= $form->field($data['model'], 'code'); ?>
<?= $form->field($data['model'], 'exchange_rate'); ?>

<?php ActiveForm::end(); ?>
