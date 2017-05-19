<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\backend\widgets\fileInput\Widget as WidgetActionImage;
use app\modules\shop\widgets\backend\DropDownListAllGroup;

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
        <?= $form->field($data['model'], 'name') ?>

        <?= $form->field($data['model'], 'parent_id')
            ->widget(DropDownListAllGroup::className())
            ->label(Yii::t('app', 'Parent group')); ?>
    </div>
    <div class="tab-pane" id="description">
        <?= $form->field($data['model'], 'image_1')->widget(WidgetActionImage::className(), [
            'behaviorName' => 'imagePreview',
        ]) ?>
        <?= $form->field($data['model'], 'description')->textarea(); ?>
    </div>
    <div class="tab-pane" id="content">
        <?= $form->field($data['model'], 'image_2')->widget(WidgetActionImage::className(), [
            'behaviorName' => 'imageContent',
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
