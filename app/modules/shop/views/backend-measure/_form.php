<?php

use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($data['model'], 'name'); ?>
<?= $form->field($data['model'], 'description')->textarea(); ?>
<?= $form->field($data['model'], 'code'); ?>

<?php ActiveForm::end(); ?>
