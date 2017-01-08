<?php
use yii\helpers\Html;
use app\modules\admin\widgets\ActiveForm;
use app\modules\shop\models\Property;

?>

<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('shop', 'Tab main'); ?></a></li>
    <li><a href="#images" data-toggle="tab"><?= Yii::t('shop', 'Tab images'); ?></a></li>
    <li><a href="#property" data-toggle="tab"><?= Yii::t('shop', 'Tab property') ?></a></li>
</ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($data->getModel()); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <div class="row">
            <div class="col-md-2">
                <div class="form-group">
                    <label><?= Yii::t('app', 'Author'); ?></label>
                    <div><?= $data->getUserFN(); ?></div>
                </div>
            </div>
            <div class="col-md-2"><?= $form->field($data->getModel(), 'code'); ?></div>
            <div class="col-md-4"><?= $form->field($data->getModel(), 'name'); ?></div>
            <div class="col-md-4"><?= $form->field($data->getModel(),
                    'status')->dropDownList($data->getModel()->getListStatus()); ?></div>
        </div>

        <div class="row">
            <div class="col-md-4"><?= $form->field($data->getModel(), 'price')
                    ->widget(\kartik\money\MaskMoney::className(), [
                        'pluginOptions' => [
                            'prefix' => 'RUR ',
                        ]
                    ]); ?>
            </div>
            <div class="col-md-4"><?= $form->field($data->getModel(), 'sku'); ?></div>
            <div class="col-md-4"><?= $form->field($data->getModification(), 'product_id')
                    ->dropDownList($data->getModel()->getListProductInGroup(), ['prompt' => ''])
                    ->label(Yii::t('shop', 'Product relation')); ?>
            </div>
        </div>

        <?= $form->field($data->getModel(), 'description')->textarea(); ?>

        <?= $form->field($data->getModel(), 'content')->widget(\vova07\imperavi\Widget::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>

        <?= $form->field($data->getModel(), 'alias'); ?>

        <?= $form->field($data->getModel(), 'meta_title'); ?>

        <?= $form->field($data->getModel(), 'meta_description')->textarea(); ?>
    </div>

    <div class="tab-pane" id="images">
        <?= $form->field($data->getModel(), 'imageUpload[]')->fileInput(['multiple' => true]); ?>
        <div class="row">
            <?php foreach ($data->getImages() as $image) : ?>
                <div class="col-md-3">
                    <div class="img-thumbnail">
                        <?= $form->field($image, '[' . $image->id . ']deleteKey')->checkbox(); ?>
                        <div class="form-group">
                            <label class="control-label">
                                <?= Html::radio('imageStatus', $image->status, ['views' => $image->id]); ?>
                                <?= Yii::t('shop', 'Image status') ?>
                            </label>
                        </div>
                        <?= $form->field($image, '[' . $image->id . ']alt'); ?>
                        <img src="<?= $image->getFileUrl(); ?>" class="width-all"/>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <div class="tab-pane" id="property">
        <?php foreach ($data->getProperty() as $value): ?>
            <?php if ($value->property->type === Property::TYPE_STRING) : ?>
                <?= $form->field($value, "[{$value->property_id}]value")
                    ->label($value->property->name); ?>
            <?php elseif ($value->property->type === Property::TYPE_BOOLEAN) : ?>
                <?= $form->field($value, "[{$value->property_id}]value")
                    ->checkbox(['label' => false])
                    ->label($value->property->name); ?>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
