<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<?= $form->field($model, 'domain'); ?>

<?= $form->field($model, 'active')->checkbox(); ?>

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'description')->textarea(); ?>

<?= $form->field($model, 'robots_txt')->textarea(); ?>

<?= $form->field($model, 'template_id')
    ->dropDownList($model->getTemplateList()); ?>

<?php ActiveForm::end(); ?>