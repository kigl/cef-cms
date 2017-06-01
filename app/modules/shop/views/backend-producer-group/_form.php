<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?php $form->errorSummary($data['model']);?>

<?= $form->field($data['model'], 'name');?>
<?= $form->field($data['model'], 'parent_id');?>
<?= $form->field($data['model'], 'description');?>
<?= $form->field($data['model'], 'content');?>
<?= $form->field($data['model'], 'image_preview');?>
<?= $form->field($data['model'], 'image');?>
<?= $form->field($data['model'], 'sorting');?>
<?= $form->field($data['model'], 'alias');?>
<?= $form->field($data['model'], 'meta_title');?>
<?= $form->field($data['model'], 'meta_description')->textarea();?>
<?= $form->field($data['model'], 'meta_keyword');?>

<?php ActiveForm::end(); ?>
