<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\backend\widgets\fileInput\Widget as ActionImage;
?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#more" data-toggle="tab"><?= Yii::t('app', 'Tab more'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'template' => "{label}\n{hint}\n{input}",
    ],
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<?= $form->errorSummary($data['model']); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <?= $form->field($data['model'], 'name'); ?>

        <?= $form->field($data['model'], 'name_hide')->checkbox();?>

        <?= $form->field($data['model'], 'url')
            ->hint('Пример: module/controller/action?param=name'); ?>

        <?= $form->field($data['model'], 'visible')->dropDownList($data['model']->getStatusVisibleList()); ?>

        <?= $form->field($data['model'], 'sorting'); ?>

        <?= $form->field($data['model'], 'image')
            ->widget(ActionImage::className(), [
                'behaviorName' => 'itemImage',
            ]); ?>
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

<?php

$str = '[]'
?>
<?php ActiveForm::end(); ?>
