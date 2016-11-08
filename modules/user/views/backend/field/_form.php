<?php
use app\modules\admin\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'name');?>

<?php ActiveForm::end();?>
