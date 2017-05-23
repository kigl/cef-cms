<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="container content">
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
        'enableAjaxValidation' => true,
        'validationUrl' => '/site/ajax',
    ]); ?>

    <?= $form->errorSummary($model); ?>

    <?= $form->field($model, 'number'); ?>

    <?= Html::submitButton(); ?>

    <?php ActiveForm::end(); ?>

    <div class="result"></div>

</div>