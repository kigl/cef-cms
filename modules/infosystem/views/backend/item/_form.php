<?php
use yii\jui\DatePicker;
use vova07\imperavi\Widget;
use app\modules\backend\widgets\ActiveForm;
use app\modules\infosystem\widgets\backend\fieldUploadImage\Widget as FieldUploadImage;
use app\modules\infosystem\widgets\backend\tagEditor\TagEditor;

//$this->params['breadcrumbs'] = $breadcrumbs;
//$this->params['breadcrumbs'][] = ['label' => $data['model']->name];
?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
        <li><a href="#description" data-toggle="tab"><?= Yii::t('app', 'Tab description'); ?></a></li>
        <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Tab content'); ?></a></li>
        <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'Tab SEO'); ?></a></li>
    </ul>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
]); ?>

<?= $form->errorSummary($data['model']); ?>

    <div class="tab-content">

        <div class="tab-pane active" id="main">
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
                        'options' => ['class' => 'form-control',],
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

            <?= $form->field($data['model'], 'editorTag')->widget(TagEditor::className(), []); ?>
        </div>

        <div class="tab-pane" id="description">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($data['model'], 'image_preview')
                        ->widget(FieldUploadImage::className(), [
                            'behaviorName' => 'UploadImagePreview',
                        ]); ?>
                </div>
            </div>

            <?= $form->field($data['model'], 'description')->widget(Widget::className(), [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 400,
                ],
            ]); ?>
        </div>

        <div class="tab-pane" id="content">

            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($data['model'], 'image_content')
                        ->widget(FieldUploadImage::className(), [
                            'behaviorName' => 'UploadImageContent',
                        ]); ?>
                </div>
            </div>

            <?= $form->field($data['model'], 'content')->widget(Widget::className(), [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 400,
                ],
            ]); ?>
        </div>

        <div class="tab-pane" id="seo">
            <?= $form->field($data['model'], 'alias'); ?>

            <?= $form->field($data['model'], 'meta_title'); ?>

            <?= $form->field($data['model'], 'meta_description')->textarea(); ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>