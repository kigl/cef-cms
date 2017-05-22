<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($data['model'], 'name');?>

<?php ActiveForm::end();?>