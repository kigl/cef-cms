<?php
use kartik\form\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
])?>

<?= $form->field($data['form'], 'parent_id')
    ->hiddenInput(['value' => isset($data['model']) ? $data['model']->id : null])
    ->label(''); ?>


<?= $form->field($data['form'], 'content')->textarea();?>

<?= Html::submitButton();?>

<?php ActiveForm::end();?>
