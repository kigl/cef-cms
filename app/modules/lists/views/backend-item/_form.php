<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data['model'])?>

<?= $form->field($data['model'], 'value');?>

<?php ActiveForm::end();?>
