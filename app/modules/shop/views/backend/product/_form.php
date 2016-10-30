<?php
use app\modules\admin\widgets\ActiveForm;
use app\modules\shop\models\Property;
?>


<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('shop', 'Tab main'); ?></a></li>
    <li><a href="#images" data-toggle="tab"><?= Yii::t('shop', 'Tab images');?></a></li>
    <li><a href="#property" data-toggle="tab"><?= Yii::t('shop', 'Tab property') ?></a></li>
</ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">

        <div class="row">
            <div class="col-md-2"><?= $form->field($model, 'code'); ?></div>
            <div class="col-md-6"><?= $form->field($model, 'name'); ?></div>
            <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList($model->getListStatus()); ?></div>
        </div>

        <div class="row">
            <div class="col-md-4"><?= $form->field($model, 'price')
                    ->widget(\kartik\money\MaskMoney::className(), [
                        'pluginOptions' => [
                            'prefix' => 'RUR ',
                        ]
                    ]); ?>
            </div>
            <div class="col-md-4"><?= $form->field($model, 'sku'); ?></div>
            <div class="col-md-4"><?= $form->field($productRelation, 'product_id')
                    ->dropDownList($model->getListProductInGroup(), ['prompt' => ''])
                    ->label(Yii::t('shop', 'Product relation'));?>
            </div>
        </div>

        <?= $form->field($model, 'description')->textarea(); ?>

        <?= $form->field($model, 'content')->widget(\vova07\imperavi\Widget::className(), [
            'settings' => [
                'minHeight' => 400,
            ],
        ]); ?>

        <?= $form->field($model, 'alias'); ?>

        <?= $form->field($model, 'meta_title'); ?>

        <?= $form->field($model, 'meta_description')->textarea(); ?>
    </div>

    <div class="tab-pane" id="images">
        <?= $form->field($model, 'image[]')->fileInput(['multiple' => true]);?>
    </div>

    <div class="tab-pane" id="property">
        <?php foreach ($productProperty as $value): ?>
            <?php if ($value->property->type === Property::TYPE_STRING) :?>
                <?= $form->field($value, "[{$value->property_id}]value")->label($value->property->name); ?>
                <?php elseif($value->property->type === Property::TYPE_BOOLEAN) :?>
                <?= $form->field($value, "[{$value->property_id}]value")->checkbox(['label' => false])->label($value->property->name); ?>
                <?php endif;?>
        <?php endforeach; ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
