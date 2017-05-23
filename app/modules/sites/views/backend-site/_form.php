<?php
use app\modules\backend\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\select2\Select2;
use app\modules\sites\models\Site;
use yii\helpers\ArrayHelper;

?>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

<?= $form->field($model, 'domain'); ?>

<?= $form->field($model, 'active')->checkbox(); ?>

<?= $form->field($model, 'name'); ?>

<?= $form->field($model, 'description')->textarea(); ?>

<?= $form->field($model, 'robots_txt')->textarea(); ?>

<?= $form->field($model, 'template_id')
    ->dropDownList($model->getTemplateList(), ['id' => 'template_id']); ?>

<?= $form->field($model, 'layout')->widget(DepDrop::classname(), [
    'options' => ['id' => 'subcat-id'],
    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
    'data' => [$model->layout => $model->layout],
    'pluginOptions' => [
        'depends' => ['template_id'],
        'initialize' => true,
        'placeholder' => 'Select...',
        'url' => Url::to(['/sites/backend-template/layouts-list']),
    ]
]); ?>

<?php ActiveForm::end(); ?>