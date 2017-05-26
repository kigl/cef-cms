<?php
use app\modules\backend\widgets\ActiveForm;
use kartik\widgets\DepDrop;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\select2\Select2;
use app\modules\sites\models\Site;
use yii\helpers\ArrayHelper;

?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
        <li><a href="#robots_txt" data-toggle="tab"><?= Yii::t('app', 'Robots.txt'); ?></a></li>
        <li><a href="#settings" data-toggle="tab"><?= Yii::t('app', 'Tab settings'); ?></a></li>
    </ul>

<?php $form = ActiveForm::begin(); ?>

<?= $form->errorSummary($model); ?>

    <div class="tab-content">
        <div class="tab-pane active" id="main">

            <?= $form->field($model, 'domain'); ?>

            <?= $form->field($model, 'name'); ?>

            <?= $form->field($model, 'description')->textarea(); ?>
        </div>
        <div class="tab-pane" id="robots_txt">

            <?= $form->field($model, 'robots_txt')->textarea(['rows' => 20]); ?>
        </div>
        <div class="tab-pane" id="settings">

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
        </div>
    </div>

<?php ActiveForm::end(); ?>