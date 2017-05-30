<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->field($data['model'], 'name'); ?>
<?= $form->field($data['model'], 'description')->textarea(); ?>

<?php ActiveForm::end(); ?>
