<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\backend\widgets\fileInput\Widget as FileInput;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Tab content'); ?></a></li>
    <li><a href="#settings" data-toggle="tab"><?= Yii::t('app', 'Tab settings'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data['model']); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <?= $form->field($data['model'], 'code'); ?>

        <?= $form->field($data['model'], 'name'); ?>

        <?= $form->field($data['model'], 'description')->textarea(); ?>
    </div>
    <div class="tab-pane" id="content">
        <?php //= $form->field($data['model'], 'image')->widget(FileInput::className()); ?>

        <?= $form->field($data['model'], 'content')->textarea(); ?>

    </div>

    <div class="tab-pane" id="settings">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#settings-main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
            <li><a href="#settings-templates" data-toggle="tab"><?= Yii::t('app', 'Tab templates'); ?></a></li>
            <li><a href="#settings-formats" data-toggle="tab"><?= Yii::t('app', 'Tab formats'); ?></a></li>
            <li><a href="#settings-sorting" data-toggle="tab"><?= Yii::t('app', 'Tab sorting'); ?></a></li>
        </ul>
        <div class="tab-content well">
            <div class="tab-pane active" id="settings-main">
                <?= $form->field($data['model'], 'group_on_page'); ?>

                <?= $form->field($data['model'], 'product_on_page'); ?>
            </div>
            <div class="tab-pane" id="settings-templates">

                <?= $form->field($data['model'], 'template'); ?>

                <?= $form->field($data['model'], 'template_group'); ?>

                <?= $form->field($data['model'], 'template_product'); ?>
            </div>
            <div class="tab-pane" id="settings-formats">

                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($data['model'], 'max_width_image_preview_group'); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($data['model'], 'max_height_image_preview_group'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($data['model'], 'max_width_image_group'); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($data['model'], 'max_height_image_group'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <?= $form->field($data['model'], 'max_width_image_product'); ?>
                    </div>
                    <div class="col-md-6">
                        <?= $form->field($data['model'], 'max_height_image_product'); ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="settings-sorting">
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($data['model'], 'sorting_type_group'); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($data['model'], 'sorting_field_group'); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($data['model'], 'sorting_list_field_group'); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $form->field($data['model'], 'sorting_type_product'); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($data['model'], 'sorting_field_product'); ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($data['model'], 'sorting_list_field_product'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="tab-pane" id="seo">
        <?= $form->field($data['model'], 'meta_title'); ?>

        <?= $form->field($data['model'], 'meta_description'); ?>

        <?= $form->field($data['model'], 'meta_keyword'); ?>
    </div>
</div>

<?php ActiveForm::end(); ?>

