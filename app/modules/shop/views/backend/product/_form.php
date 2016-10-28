<?php
use app\modules\admin\widgets\ActiveForm;

?>


<ul class="nav nav-tabs">
    <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('shop', 'Tab main'); ?></a></li>
    <li><a href="#property" data-toggle="tab"><?= Yii::t('shop', 'Tab property') ?></a></li>
</ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<div class="tab-content">
    <div class="tab-pane active" id="main">
        <div class="row">
            <div class="col-md-12"><?= $form->field($model, 'name'); ?></div>
        </div>

        <div class="row">
            <div class="col-md-12"><?= $form->field($productRelation, 'product_id')->dropDownList($model->getListProductInGroup(), ['prompt' => '']);?></div>
        </div>

        <div class="row">
            <div class="col-md-2"><?= $form->field($model, 'code'); ?></div>
            <div class="col-md-3"><?= $form->field($model, 'price'); ?></div>
            <div class="col-md-3"><?= $form->field($model, 'depot'); ?></div>
            <div class="col-md-4"><?= $form->field($model, 'status')->dropDownList($model->getListStatus()); ?></div>
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

    <div class="tab-pane" id="property">
        <?php foreach ($productProperty as $value): ?>
            <?= $form->field($value, "[{$value->property_id}]value")->label($value->property->name); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php ActiveForm::end(); ?>
