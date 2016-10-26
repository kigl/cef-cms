<?php
use app\modules\admin\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?=$form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?php ActiveForm::end();?>
