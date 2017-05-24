<?php
use app\modules\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([
    'enableClientValidation' => false,
]);?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'description');?>

<?= $form->field($model, 'email_from');?>

<?= $form->field($model, 'email_curator')?>

<?= $form->field($model, 'send_email_curator')->checkbox();?>

<?= $form->field($model, 'captcha')->checkbox();?>

<?php ActiveForm::end();?>