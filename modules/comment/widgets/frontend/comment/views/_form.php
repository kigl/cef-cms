<?php
use kartik\form\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
])?>

<?= $form->field($data['form'], 'parent_id')
    ->hiddenInput(['value' => null, 'id' => 'kill'])
    ->label(''); ?>


<?= $form->field($data['form'], 'content')->textarea();?>

<?= Html::submitButton();?>

<?php ActiveForm::end();?>
