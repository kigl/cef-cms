<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>


<?php $form = ActiveForm::begin([
    'id' => 'comment-form',
    'options' => [
        'data-pjax' => true,
        'class' => 'well well-sm'
    ],
]);
?>

<?= $form->field($data['form'], 'parent_id', [
    'template' => '{input}',
])
    ->hiddenInput(['value' => null, 'id' => 'comment-input-parent_id'])
    ->label(''); ?>


<?= $form->field($data['form'], 'content')->textarea(); ?>

<?= Html::submitButton(Yii::t('app', 'Button add'), ['class' => 'btn btn-primary btn-sm']); ?>

<?php ActiveForm::end(); ?>
