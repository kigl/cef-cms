<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
    'action' => '/shop/search',
    'method' => 'get',
]);?>
<?= Html::textInput('value', $value);?>
<?= Html::submitButton(Yii::t('shop', 'Search button'));?>
<?php ActiveForm::end();?>
