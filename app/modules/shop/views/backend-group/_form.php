<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\backend\widgets\fileInput\Widget as FileInput;
use app\core\widgets\DropDownTreeItems;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#description" data-toggle="tab"><?= Yii::t('app', 'Tab description'); ?></a></li>
    <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Tab content'); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'Tab SEO'); ?></a></li>
    <li><a href="#other" data-toggle="tab"><?= Yii::t('app', 'Tab more'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<?= $form->errorSummary($data['model']); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <div class="row">
            <div class="col-md-2">
                <?= $form->field($data['model'], 'active')->checkbox(); ?>
            </div>
            <div class="col-md-10">
                <?= $form->field($data['model'], 'name') ?>
            </div>
        </div>
        <?= $form->field($data['model'], 'parent_id')
            ->widget(DropDownTreeItems::className())
            ->label(Yii::t('app', 'Parent group')); ?>
    </div>

    <div class="tab-pane" id="description">
        <?= $form->field($data['model'], 'image_preview')->widget(FileInput::className(), [
            'behaviorName' => 'imagePreview',
        ]) ?>
        <?= $form->field($data['model'], 'description')->textarea(); ?>
    </div>

    <div class="tab-pane" id="content">
        <?= $form->field($data['model'], 'image')->widget(FileInput::className(), [
            'behaviorName' => 'image',
        ]) ?>
        <?= $form->field($data['model'], 'content')->widget(\vova07\imperavi\Widget::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>
    </div>
    
    <div class="tab-pane" id="seo">
        <?= $form->field($data['model'], 'alias'); ?>

        <?= $form->field($data['model'], 'meta_title'); ?>

        <?= $form->field($data['model'], 'meta_description')->textarea(); ?>
    </div>

    <div class="tab-pane" id="other">
        <?= \yii\widgets\DetailView::widget([
            'model' => $data['model'],
            'attributes' => [
                'id'
            ],
        ]) ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
