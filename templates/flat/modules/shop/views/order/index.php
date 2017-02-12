<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data->getModel(), ['class' => 'alert alert-danger']);?>

<?= $form->field($data->getModel(), 'country');?>

<?= $form->field($data->getModel(), 'region');?>

<?= $form->field($data->getModel(), 'city');?>

<?= $form->field($data->getModel(), 'postcode');?>

<?= $form->field($data->getModel(), 'address');?>

<?= $form->field($data->getModel(), 'company');?>

<?= $form->field($data->getModel(), 'phone');?>

<?= $form->field($data->getModel(), 'comment')->textarea();?>

<?= Html::submitButton(Yii::t('shop', 'Checkout'), ['class' => 'btn btn-primary']);?>

<?php ActiveForm::end();?>