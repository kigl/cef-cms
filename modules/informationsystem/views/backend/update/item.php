<?php
use yii\jui\DatePicker;
use vova07\imperavi\Widget;
use app\modules\admin\widgets\ActiveForm;
use app\modules\informationsystem\widgets\backend\fileInForm\Widget as FileInForm;
use app\modules\informationsystem\widgets\backend\tagEditor\TagEditor;

$this->params['breadcrumbs'] = $breadcrumbs;
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'name'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'date')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'dateFormat' => 'dd-MM-yyyy',
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'date_start')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'dateFormat' => 'dd-MM-yyyy',
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'date_end')->widget(DatePicker::className(), [
                'options' => ['class' => 'form-control'],
                'dateFormat' => 'dd-MM-yyyy',
            ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'status')->dropDownList($model->getStatusList()); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sort'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($model, 'image')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteImage',
                'behaviorName' => 'imageUpload'
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'video')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteVideo',
                'behaviorName' => 'videoUpload',
            ]); ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($model, 'file')->widget(FileInForm::className(), [
                'deleteKey' => 'deleteFile',
                'behaviorName' => 'fileUpload',
            ]); ?>
        </div>
    </div>

<?= $form->field($model, 'editorTag')->widget(TagEditor::className(), []); ?>

<?= $form->field($model, 'description')->textArea(); ?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]); ?>

<?php ActiveForm::end(); ?>