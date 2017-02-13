<?php
use app\modules\backend\widgets\ActiveForm;
use vova07\imperavi\Widget;

//$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data['model']); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($data['model'], 'name'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($data['model'], 'image')->fileInput(); ?>
        </div>
    </div>


<?= $form->field($data['model'], 'description')->textArea(); ?>

<?= $form->field($data['model'], 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]); ?>

    <legend><?= Yii::t('app', 'Form legend seo'); ?></legend>

<?= $form->field($data['model'], 'alias'); ?>

<?= $form->field($data['model'], 'meta_title'); ?>

<?= $form->field($data['model'], 'meta_description')->textArea(); ?>

<?php ActiveForm::end(); ?>