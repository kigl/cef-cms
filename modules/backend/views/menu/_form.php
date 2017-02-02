<?php
use app\modules\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'class');?>

<?= $form->field($model, 'attribute_id');?>

<?php ActiveForm::end();?>
