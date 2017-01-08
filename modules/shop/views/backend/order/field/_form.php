<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 01.01.2017
 * Time: 19:08
 */
use app\modules\admin\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin([]);?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?php ActiveForm::end();?>