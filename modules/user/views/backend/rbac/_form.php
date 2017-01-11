<?php
use app\modules\admin\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data->getModel());?>

<?= $form->field($data->getModel(), 'name');?>

<?= $form->field($data->getModel(), 'description');?>

<?php ActiveForm::end();?>
