<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($data->getModel(), 'email'); ?>

<?= Html::submitButton();?>

<?php ActiveForm::end();?>
