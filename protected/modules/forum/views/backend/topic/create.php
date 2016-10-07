<?php
use app\modules\main\widgets\backend\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'parent_id')->hiddenInput(['value' => $parent_id])->label(false);?>

<?= $form->field($model, 'name');?>

<?php ActiveForm::end();?>