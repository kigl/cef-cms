<?php
use yii\helpers\ArrayHelper;
use app\modules\main\widgets\ActiveForm;

$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'informationsystem_id')->hiddenInput(['value' => $model->informationsystem_id])->label(false);?>

<?= $form->field($model, 'name');?>

<?php ActiveForm::end();?>