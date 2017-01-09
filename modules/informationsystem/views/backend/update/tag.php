<?php
use app\modules\admin\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($data->getModel(), 'name');?>

<?php ActiveForm::end();?>