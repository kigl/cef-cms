<?php
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin([]); ?>

<?= $form->errorSummary($data['model']); ?>

<div class="row">
    <div class="col-md-3">
        <?= $form->field($data['model'], 'register_status')->dropDownList($data['model']->getListstatus()); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($data['model'], 'register_group')->dropDownList($data['model']->getAuthItem()); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($data['model'], 'avatar_width'); ?>
    </div>
    <div class="col-md-3">
        <?= $form->field($data['model'], 'avatar_height'); ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
