<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin() ?>

<?= $form->errorSummary($data['model']); ?>

<?= $form->field($data['model'], 'name'); ?>
<?= $form->field($data['model'], 'description')->textarea(); ?>
<?= $form->field($data['model'], 'country_id'); ?>
<?= $form->field($data['model'], 'region_id'); ?>
<?= $form->field($data['model'], 'city_id'); ?>
<?= $form->field($data['model'], 'address'); ?>

<?php ActiveForm::end(); ?>
