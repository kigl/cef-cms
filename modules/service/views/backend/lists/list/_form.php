<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'description');?>

<?php ActiveForm::end();?>
