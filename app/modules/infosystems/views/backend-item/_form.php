<?php
use yii\jui\DatePicker;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\widgets\Select2;
use vova07\imperavi\Widget;
use app\modules\backend\widgets\ActiveForm;
use app\modules\backend\widgets\fileInput\Widget as ActionImage;
use app\modules\infosystems\widgets\backend\DropDownTreeItems;
use app\modules\infosystems\Module;

?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
        <li><a href="#description" data-toggle="tab"><?= Yii::t('app', 'Tab description'); ?></a></li>
        <li><a href="#content" data-toggle="tab"><?= Yii::t('app', 'Tab content'); ?></a></li>
        <?php if ($data['itemProperties']) : ?>
            <li><a href="#properties" data-toggle="tab"><?= Yii::t('app', 'Tab properties'); ?></a></li>
        <?php endif; ?>
        <li><a href="#seo" data-toggle="tab"><?= Yii::t('app', 'Tab SEO'); ?></a></li>
        <li><a href="#other" data-toggle="tab"><?= Yii::t('app', 'Tab other'); ?></a></li>
    </ul>

<?php $form = ActiveForm::begin([
    'options' => ['enctype' => 'multipart/form-data'],
    'enableClientValidation' => false,
]); ?>
<?= $form->errorSummary(array_merge($data['itemProperties'], [$data['model']])); ?>

    <div class="tab-content">

        <div class="tab-pane active" id="main">

            <div class="row">
                <div class="col-md-6">
                    <?= $form->field($data['model'], 'name'); ?>
                </div>
                <div class="col-md-6">

                    <?= $form->field($data['model'], 'listTags')->widget(Select2::classname(), [
                        'data' => ArrayHelper::map($data['tags'], 'id', 'name'),
                        'options' => ['placeholder' => Module::t('Select a tags') , 'multiple' => true],
                    ])->label(Module::t('Tags')); ?>

                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <?= $form->field($data['model'], 'group_id')
                        ->widget(DropDownTreeItems::className(), [
                            'modelClass' => \app\modules\infosystems\models\Group::className(),
                        ]); ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($data['model'], 'status')
                        ->dropDownList($data['model']->getStatusList()); ?>
                </div>
                <div class="col-md-4">
                    <?= $form->field($data['model'], 'sorting'); ?>
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
                    <?= $form->field($data['model'], 'file')
                        ->widget(ActionImage::className(), [
                            'behaviorName' => 'file',
                        ]); ?>
                </div>
            </div>
        </div>

        <div class="tab-pane" id="description">
            <div class="row">
                <div class="col-md-12">
                    <?= $form->field($data['model'], 'image_description')
                        ->widget(ActionImage::className(), [
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
                        ->widget(ActionImage::className(), [
                            'behaviorName' => 'imageContent',
                        ]); ?>
                </div>
            </div>

            <?= $form->field($data['model'], 'content')->widget(Widget::className(), [
                'settings' => [
                    'minHeight' => 400,
                    'deniedTags' => ['style'],
                    'imageManagerJson' => Url::to(['images-get']),
                    'imageUpload' => Url::to(['image-upload']),
                    'plugins' => [
                        'imagemanager',
                    ]
                ]
            ]); ?>

        </div>

        <div class="tab-pane" id="properties">
            <?php foreach ($data['itemProperties'] as $key => $property) : ?>
                <?= $form->field($property, '[' . $key . ']value')
                    ->label($data['properties'][$key]->name); ?>
            <?php endforeach; ?>
        </div>

        <div class="tab-pane" id="seo">
            <?= $form->field($data['model'], 'alias'); ?>

            <?= $form->field($data['model'], 'meta_title'); ?>

            <?= $form->field($data['model'], 'meta_description')->textarea(); ?>
        </div>

        <div class="tab-pane" id="other">
            <?= \yii\widgets\DetailView::widget([
                'model' => $data['model'],
                'attributes' => [
                    'id',
                    'counter',
                    'user_id'
                ],
            ]); ?>
        </div>
    </div>

<?php ActiveForm::end(); ?>