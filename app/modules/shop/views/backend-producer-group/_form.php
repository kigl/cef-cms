<?php
use yii\widgets\DetailView;
use app\modules\backend\widgets\ActiveForm;
use app\core\widgets\DropDownTreeItems;
use vova07\imperavi\Widget as Imperavi;
use app\modules\backend\widgets\fileInput\Widget as FileInput;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Main'); ?></a></li>
    <li><a href="#description" data-toggle="tab"><?= Yii::t('app', 'Description'); ?></a></li>
    <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Content'); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'SEO'); ?></a></li>
    <li><a href="#other" data-toggle="tab"><?= Yii::t('app', 'Other'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<?= $form->errorSummary($data['model']); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <?= $form->field($data['model'], 'name'); ?>
        <?= $form->field($data['model'], 'parent_id')
            ->widget(DropDownTreeItems::className())
            ->label(Yii::t('app', 'Parent group')); ?>
        <?= $form->field($data['model'], 'sorting'); ?>
    </div>
    <div class="tab-pane" id="description">
        <?= $form->field($data['model'], 'image_preview')->widget(FileInput::className(), [
            'behaviorName' => 'imagePreview',
        ]) ?>
        <?= $form->field($data['model'], 'description')->textarea(['rows' => 5]); ?>
    </div>
    <div class="tab-pane" id="content">
        <?= $form->field($data['model'], 'image')->widget(FileInput::className(), [
            'behaviorName' => 'image',
        ]) ?>
        <?= $form->field($data['model'], 'content')->widget(Imperavi::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>
    </div>
    <div class="tab-pane" id="seo">
        <?= $form->field($data['model'], 'alias'); ?>
        <?= $form->field($data['model'], 'meta_title'); ?>
        <?= $form->field($data['model'], 'meta_description')->textarea(); ?>
        <?= $form->field($data['model'], 'meta_keyword'); ?>
    </div>
    <div class="tab-pane" id="other">
        <?= DetailView::widget([
            'model' => $data['model'],
            'attributes' => [
                'id'
            ],
        ]); ?>
    </div>
</div>

<?php ActiveForm::end(); ?>
