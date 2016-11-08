<?php
use app\modules\admin\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?=$form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'type')->dropDownList($model->getListType());?>

<?php ActiveForm::end();?>
