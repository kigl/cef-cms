<?php
use app\modules\main\widgets\backend\ActiveForm;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'topic_id')->hiddenInput()->label(false);?>

<?= $form->field($model, 'content')->textArea();?>

<?php ActiveForm::end();?>