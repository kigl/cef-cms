<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data['model']); ?>

<?= $form->field($data['model'], 'type')->dropDownList($data['model']->getListType());?>

<?= $form->field($data['model'], 'name'); ?>

<?= $form->field($data['model'], 'description'); ?>

<?= $form->field($data['model'], 'ruleName');?>

<?= $form->field($data['model'], 'child')
    ->dropDownList($data['model']->getItems(), [
        'prompt' => Yii::t('app', 'Not selected'),
        'size' => 10,
        'multiple' => 'multiple',
        'groups' => [
            '1' => ['label' => Yii::t('app', 'Type role')],
            '2' => ['label' => Yii::t('app', 'Type permission')]
            ],
        ]);
?>

<?php ActiveForm::end(); ?>
