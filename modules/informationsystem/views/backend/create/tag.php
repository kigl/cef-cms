<?php
use yii\helpers\ArrayHelper;
use app\modules\backend\widgets\ActiveForm;

?>

<?php $form = ActiveForm::begin();?>

<?= $form->field($data->getModel(), 'name');?>

<?php ActiveForm::end();?>