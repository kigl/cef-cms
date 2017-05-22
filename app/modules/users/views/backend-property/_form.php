<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'description')->textarea();?>

<?= $form->field($model, 'required')->checkbox();?>

<?php ActiveForm::end();?>
