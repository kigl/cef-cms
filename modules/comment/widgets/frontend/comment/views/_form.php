<?php
use kartik\form\ActiveForm;
use yii\helpers\Html;
use app\core\widgets\Alert;

?>

<?php \yii\widgets\Pjax::begin([
    'id' => 'pjax-comment-form',
]); ?>

<?= Alert::widget(); ?>

<?php $form = ActiveForm::begin([
    'options' => ['data-pjax' => true],
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
<?php \yii\widgets\Pjax::end(); ?>
