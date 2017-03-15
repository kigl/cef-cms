<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<div class="panel panel-default">
    <div class="panel-heading">Поиск</div>
    <div class="panel-body">

        <?php $form = ActiveForm::begin([
            'action' => '/shop/search',
            'method' => 'get',
        ]); ?>
        <div class="row">
            <div class="col-md-10">
                <?= Html::textInput('value', $value, ['class' => 'form-control']); ?>
            </div>
            <div class="col-md-2">
                <?= Html::submitButton(Yii::t('shop', 'Search button'), ['class' => 'btn btn-primary']); ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
