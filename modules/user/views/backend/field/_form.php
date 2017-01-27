<?php
use app\modules\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'name');?>

<?php ActiveForm::end();?>
