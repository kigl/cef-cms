<?php
use yii\helpers\Url;
use kigl\cef\module\backend\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;
use conquer\codemirror\CodemirrorWidget;
use conquer\codemirror\CodemirrorAsset;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Tab content'); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'Tab SEO'); ?></a></li>
</ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <?= $form->field($model, 'name'); ?>
    </div>
    <div class="tab-pane" id="content">
        <?= $form->field($model, 'content')
            ->widget(Imperavi::className(), [
                'settings' => [
                    'minHeight' => 400,
                    'imageManagerJson' => Url::to(['/backend/page/page/images-get']),
                    'imageUpload' => Url::to(['/backend/page/page/image-upload']),
                    'plugins' => [
                        'imagemanager',
                        'fullscreen',
                    ]
                ]
            ]); ?>

        <?= $form->field($model, 'dynamicPage')->widget(
            CodemirrorWidget::className(),
            [
                'options' => ['rows' => 20],
                'settings' => [
                    'lineNumbers' => true,
                ],
            ]
        ); ?>
    </div>
    <div class="tab-pane" id="seo">
        <?= $form->field($model, 'alias'); ?>

        <?= $form->field($model, 'meta_title'); ?>

        <?= $form->field($model, 'meta_description'); ?>

    </div>
</div>
<?php ActiveForm::end(); ?>
