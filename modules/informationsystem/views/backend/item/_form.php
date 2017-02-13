<?php
use yii\jui\DatePicker;
use vova07\imperavi\Widget;
use app\modules\backend\widgets\ActiveForm;
use app\modules\informationsystem\widgets\backend\fileInForm\Widget as FileInForm;
use app\modules\informationsystem\widgets\backend\tagEditor\TagEditor;

//$this->params['breadcrumbs'] = $breadcrumbs;
//$this->params['breadcrumbs'][] = ['label' => $data['model']->name];
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data['model']); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($data['model'], 'name'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($data['model'], 'date')
                ->widget(DatePicker::className(), [
                    'options' => ['class' => 'form-control'],
                ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data['model'], 'date_start')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control']
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data['model'], 'date_end')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control']
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($data['model'], 'status')
                ->dropDownList($data['model']->getStatusList()); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($data['model'], 'sorting'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($data['model'], 'image')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteImage',
                'behaviorName' => 'imageUpload'
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data['model'], 'video')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteVideo',
                'behaviorName' => 'videoUpload',
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data['model'], 'file')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteFile',
                'behaviorName' => 'fileUpload',
            ]); ?>
        </div>
    </div>

<?= $form->field($data['model'], 'editorTag')->widget(TagEditor::className(), []); ?>

<?= $form->field($data['model'], 'description')->textArea(); ?>

<?= $form->field($data['model'], 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]); ?>

    <legend><?= Yii::t('app', 'Form legend seo'); ?></legend>

<?= $form->field($data['model'], 'meta_title'); ?>

<?= $form->field($data['model'], 'meta_description')->textarea(); ?>

<?php ActiveForm::end(); ?>