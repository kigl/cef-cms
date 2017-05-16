<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;

?>

<?php $form = ActiveForm::begin([
    'id' => 'comment-form',
    'action' => ['/comment/comment/add'],
    'enableAjaxValidation' => true,
    'enableClientValidation' => false,
    'options' => [
        'class' => 'well well-sm',
    ],
]);
?>

<div class="has-success" id="result">
    <span class="help-block help-block-success strong"></span>
</div>

<?= $form->field($data['form'], 'model_class', ['template' => "{input}"])
    ->hiddenInput(); ?>

<?= $form->field($data['form'], 'item_id', ['template' => "{input}"])
    ->hiddenInput(); ?>

<?= $form->field($data['form'], 'parent_id', [
    'template' => '{input}',
])
    ->hiddenInput(['value' => null, 'id' => 'comment-input-parent_id'])
    ->label(''); ?>


<?= $form->field($data['form'], 'content')->textarea(['rows' => 4]); ?>

<?= Html::submitButton(Yii::t('app', 'Button add'), ['class' => 'btn btn-primary btn-sm']); ?>

<?php ActiveForm::end(); ?>
