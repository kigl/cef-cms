<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\lists\widgets\DropDownLists;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data['model']); ?>

<?= $form->field($data['model'], 'name'); ?>

<?= $form->field($data['model'], 'description')->textarea(); ?>

<?= $form->field($data['model'], 'type')->dropDownList($data['model']->getListType(), ['id' => 'input-type']); ?>

<?= $form->field($data['model'], 'list_id', ['options' => ['id' => 'list_id', 'class' => 'form-group']])
    ->widget(DropDownLists::className(), ['options' => ['class' => 'form-control']]); ?>

<?= $form->field($data['model'], 'sorting'); ?>

<?= $form->field($data['model'], 'required')->checkbox(); ?>

<?php ActiveForm::end(); ?>

<?php
$this->registerJs("
    $(function () {
        var typeInput = $('#input-type'),
            typeSelect = '4',
            blockListId = $('#list_id'),
            cssCollapse = 'collapse';

        if (typeInput.val() != typeSelect) {
            blockListId.addClass(cssCollapse);
        }

        typeInput.on('change', function () {
            if (typeInput.val() == typeSelect) {
                blockListId.removeClass(cssCollapse);
            } else {
                blockListId.addClass(cssCollapse);
            }
        });
    });
    ") ?>
