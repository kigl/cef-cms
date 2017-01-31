<?
use app\modules\backend\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data->getModel());?>

<div class="row">
    <div class="col-md-4"><?= $form->field($data->getModel(), 'name')?></div>
    <div class="col-md-4">
        <?= $form->field($data->getModel(), 'status')
            ->dropDownList($data->getModel()->getStatusList());?>
    </div>
    <div class="col-md-4"><?= $form->field($data->getModel(), 'sort')?></div>
</div>

<?= $form->field($data->getModel(), 'description')->textarea();?>

<?= $form->field($data->getModel(), 'content')->widget(\vova07\imperavi\Widget::className(), [
    'settings' => [
        'minHeight' => 400,
    ],
]);?>

<legend><?= Yii::t('app', 'Form legend seo');?></legend>

<?= $form->field($data->getModel(), 'alias');?>

<?= $form->field($data->getModel(), 'meta_title');?>

<?= $form->field($data->getModel(), 'meta_description')->textarea();?>

<?php ActiveForm::end();?>
