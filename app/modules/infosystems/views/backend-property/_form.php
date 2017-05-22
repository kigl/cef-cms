<?php
use app\modules\backend\widgets\ActiveForm;
use yii\widgets\Pjax;

?>

<?php Pjax::begin([
    'id' => 'create-property-pjax',
]);?>
<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true]
]); ?>

<?= $form->errorSummary($data['model']);?>

<?= $form->field($data['model'], 'name'); ?>

<?= $form->field($data['model'], 'description'); ?>

<?= $form->field($data['model'], 'required')->checkbox(); ?>

<?php ActiveForm::end(); ?>
<?php Pjax::end();?>

