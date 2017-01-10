<?php
use yii\jui\DatePicker;
use vova07\imperavi\Widget;
use app\modules\admin\widgets\ActiveForm;
use app\modules\informationsystem\widgets\backend\fileInForm\Widget as FileInForm;
use app\modules\informationsystem\widgets\backend\tagEditor\TagEditor;

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->errorSummary($data->getModel()); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($data->getModel(), 'name'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($data->getModel(), 'date')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'dateFormat' => 'dd-MM-yyyy',
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data->getModel(), 'date_start')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'dateFormat' => 'dd-MM-yyyy',
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data->getModel(), 'date_end')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'dateFormat' => 'dd-MM-yyyy',
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($data->getModel(), 'status')->dropDownList($data->getStatusList()); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($data->getModel(), 'sort'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($data->getModel(), 'image')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteImage',
                'behaviorName' => 'imageUpload'
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data->getModel(), 'video')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteVideo',
                'behaviorName' => 'videoUpload',
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($data->getModel(), 'file')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteFile',
                'behaviorName' => 'fileUpload',
            ]); ?>
        </div>
    </div>

<?= $form->field($data->getModel(), 'editorTag')->widget(TagEditor::className(), []); ?>

<?= $form->field($data->getModel(), 'description')->textArea(); ?>

<?= $form->field($data->getModel(), 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]); ?>

<?php ActiveForm::end(); ?>