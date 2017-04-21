<?php
use yii\helpers\Url;
use app\modules\backend\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
    <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Tab content'); ?></a></li>
    <li><a href="#dynamicData" data-toggle="tab"><?= Yii::t('page', 'Tab dynamic data'); ?></a></li>
    <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'Tab SEO'); ?></a></li>
    <li><a href="#other" data-toggle="tab"><?= Yii::t('app', 'Tab other'); ?></a></li>
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
                    'deniedTags' => ['style'],
                    'imageManagerJson' => Url::to(['page/images-get']),
                    'imageUpload' => Url::to(['image-upload']),
                    'plugins' => [
                        'imagemanager',
                        'fullscreen',
                    ]
                ]
            ]); ?>
    </div>
    <div class="tab-pane" id="dynamicData">
        <?= $form->field($model, 'dynamicData')->textarea([
            'rows' => 20,
        ]); ?>
    </div>
    <div class="tab-pane" id="seo">
        <?= $form->field($model, 'alias'); ?>

        <?= $form->field($model, 'meta_title'); ?>

        <?= $form->field($model, 'meta_description')->textarea(); ?>
    </div>
    <div class="tab-pane" id="other">
        <?= \yii\widgets\DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id'
            ],
        ]) ?>
    </div>
</div>
<?php ActiveForm::end(); ?>