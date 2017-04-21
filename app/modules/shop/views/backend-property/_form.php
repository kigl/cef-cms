<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\lists\widgets\DropDownLists;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'description')->textarea(); ?>

<?= $form->field($model, 'type')->dropDownList($model->getListType(), ['id' => 'input-type']); ?>

<?= $form->field($model, 'list_id', ['options' => ['id' => 'list_id', 'class' => 'form-group']])
    ->widget(DropDownLists::className(), ['options' => ['class' => 'form-control']]); ?>

<?= $form->field($model, 'sorting'); ?>

<?= $form->field($model, 'required')->checkbox(); ?>

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
