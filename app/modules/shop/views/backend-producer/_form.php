<?php
use yii\widgets\DetailView;
use vova07\imperavi\Widget as Imperavi;
use app\modules\backend\widgets\ActiveForm;
use app\core\widgets\DropDownTreeItems;
use app\modules\backend\widgets\fileInput\Widget as FileInput;
use app\modules\shop\models\ProducerGroup;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Main'); ?></a></li>
    <li><a href="#description" data-toggle="tab"><?= Yii::t('app', 'Description'); ?></a></li>
    <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Content'); ?></a></li>
    <li><a href="#contactDetails" data-toggle="tab"><?= Yii::t('app', 'Contact details'); ?></a></li>
    <li><a href="#bankDetails" data-toggle="tab"><?= Yii::t('app', 'Bank details'); ?></a></li>
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
        <?= $form->field($data['model'], 'group_id')
            ->widget(DropDownTreeItems::className(), [
                'modelClass' => ProducerGroup::className(),
            ])
            ->label(Yii::t('app', 'Group')); ?>
        <?= $form->field($data['model'], 'sorting'); ?>
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
        <?= $form->field($data['model'], 'content')->widget(Imperavi::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>
    </div>
    <div class="tab-pane" id="contactDetails">
        <?= $form->field($data['model'], 'address'); ?>
        <?= $form->field($data['model'], 'phone'); ?>
        <?= $form->field($data['model'], 'fax'); ?>
        <?= $form->field($data['model'], 'site'); ?>
        <?= $form->field($data['model'], 'email'); ?>
    </div>
    <div class="tab-pane" id="bankDetails">
        <?= $form->field($data['model'], 'tin'); ?>
        <?= $form->field($data['model'], 'kpp'); ?>
        <?= $form->field($data['model'], 'psrn'); ?>
        <?= $form->field($data['model'], 'okpo'); ?>
        <?= $form->field($data['model'], 'okved'); ?>
        <?= $form->field($data['model'], 'bik'); ?>
        <?= $form->field($data['model'], 'account_number'); ?>
        <?= $form->field($data['model'], 'bank_name'); ?>
        <?= $form->field($data['model'], 'bank_address'); ?>
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
