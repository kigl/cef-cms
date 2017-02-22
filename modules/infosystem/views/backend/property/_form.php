<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([
    'id' => 'test',
]); ?>

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'description'); ?>

<?= $form->field($model, 'required')->checkbox(); ?>

<?php ActiveForm::end(); ?>

