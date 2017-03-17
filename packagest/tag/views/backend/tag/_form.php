<?php
use kigl\cef\module\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($data['model'], 'name');?>

<?php ActiveForm::end();?>