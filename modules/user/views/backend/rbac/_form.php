<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data->getModel()); ?>

<?= $form->field($data->getModel(), 'name'); ?>

<?= $form->field($data->getModel(), 'description'); ?>

<?= $form->field($data->getModel(), 'child')
    ->dropDownList($data->getModel()->getItems(), ['prompt' => '', 'size' => 10, 'multiple' => 'multiple']);
?>

<?php ActiveForm::end(); ?>
