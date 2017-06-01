<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data['model']);?>

<?= $form->field($data['model'], 'measure_id')
    ->dropDownList($data['measureList']);?>
<?= $form->field($data['model'], 'main')->checkbox();?>
<?= $form->field($data['model'], 'name');?>
<?= $form->field($data['model'], 'value');?>
<?= $form->field($data['model'], 'length');?>
<?= $form->field($data['model'], 'width');?>
<?= $form->field($data['model'], 'height');?>

<?php ActiveForm::end();?>
