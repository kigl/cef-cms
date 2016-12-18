<?php
use yii\helpers\ArrayHelper;
use app\modules\admin\widgets\ActiveForm;

$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($model, 'informationsystem_id')->hiddenInput(['views' => $informationsytem_id])->label(false);?>

<?= $form->field($model, 'name');?>

<?php ActiveForm::end();?>