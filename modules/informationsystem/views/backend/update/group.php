<?php

use app\modules\admin\widgets\imageInForm\Widget as ImageInForm;
use app\modules\admin\widgets\ActiveForm;
use vova07\imperavi\Widget;

$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'name'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= ImageInForm::widget([
                'model' => $model,
                'attribute' => 'image',
            ]);
            ?>
            <?= $form->field($model, 'image')->fileInput(); ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sort'); ?>
        </div>
    </div>

<?= $form->field($model, 'description')->textArea(); ?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]); ?>

<?= $form->field($model, 'alias'); ?>

<?= $form->field($model, 'meta_title'); ?>

<?= $form->field($model, 'meta_description')->textArea(); ?>

<?php ActiveForm::end(); ?>