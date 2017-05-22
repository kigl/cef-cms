<?php
use yii\bootstrap\Collapse;
use app\modules\backend\widgets\ActiveForm;
use vova07\imperavi\Widget;
use app\modules\backend\widgets\fileInput\Widget as WidgetActionImage;
use app\modules\infosystems\widgets\backend\DropDownListItems;

$this->params['breadcrumbs'] = $data['breadcrumbs'];
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

                    <?= $form->field($data['model'], 'status')
                        ->dropDownList($data['model']->getStatusList()); ?>

                    <?= $form->field($data['model'], 'parent_id')
                        ->widget(DropDownListItems::className())
                        ->label(Yii::t('app', 'Parent group')); ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="description">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($data['model'], 'image_description')
                        ->widget(WidgetActionImage::className(), [
                            'behaviorName' => 'imageDescription',
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
                        ->widget(WidgetActionImage::className(), [
                            'behaviorName' => 'imageContent',
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

            <?= $form->field($data['model'], 'meta_description')->textArea(); ?>
        </div>

    </div>
<?php ActiveForm::end(); ?>