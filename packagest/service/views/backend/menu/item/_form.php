<?php
use kigl\cef\module\backend\widgets\ActiveForm;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#more" data-toggle="tab"><?= Yii::t('app', 'Tab more'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data['model']); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <?= $form->field($data['model'], 'name'); ?>

        <?= $form->field($data['model'], 'url'); ?>

        <?= $form->field($data['model'], 'visible')->dropDownList($data['model']->getStatusVisibleList()); ?>

        <?= $form->field($data['model'], 'sorting'); ?>
    </div>
    <div class="tab-pane" id="more">

        <p class="alert alert-danger">Пока не работает</p>
        <?= $form->field($data['model'], 'item_icon_class'); ?>

        <?= $form->field($data['model'], 'item_class'); ?>

        <?= $form->field($data['model'], 'item_id'); ?>

        <?= $form->field($data['model'], 'link_class'); ?>

        <?= $form->field($data['model'], 'link_id'); ?>

    </div>
</div>
<?php ActiveForm::end(); ?>
