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

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'description'); ?>

<?= $form->field($model, 'required')->checkbox(); ?>

<?php ActiveForm::end(); ?>
<?php Pjax::end();?>

