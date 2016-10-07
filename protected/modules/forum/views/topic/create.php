<?php
use app\modules\main\widgets\backend\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($modelTopic);?>

<?= $form->field($modelTopic, 'parent_id')->hiddenInput(['value' => $parentId])->label(false);?>

<?= $form->field($modelTopic, 'name');?>

<?= $form->field($modelPost, 'content')->textArea();?>

<?php ActiveForm::end();?>