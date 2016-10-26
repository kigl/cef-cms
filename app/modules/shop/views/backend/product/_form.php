<?php
use app\modules\admin\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<div class="row">
    <div class="col-md-12"><?= $form->field($model, 'name');?></div>
</div>

<div class="row">
    <div class="col-md-2"><?= $form->field($model, 'code');?></div>
    <div class="col-md-3"><?= $form->field($model, 'price');?></div>
    <div class="col-md-3"><?= $form->field($model, 'depot');?></div>
    <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList($model->getListStatus());?></div>
</div>

<?= $form->field($model, 'description')->textarea();?>

<?= $form->field($model, 'content')->widget(\vova07\imperavi\Widget::className(), [
    'settings' => [
        'minHeight' => 400,
    ],
]);?>

<?= $form->field($model, 'alias');?>

<?= $form->field($model, 'meta_title');?>

<?= $form->field($model, 'meta_description')->textarea();?>

<?php ActiveForm::end();?>
