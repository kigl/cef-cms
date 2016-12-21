<?php
use yii\widgets\ActiveForm;

?>

<?php \yii\widgets\Pjax::begin([
        'enablePushState' => false
]); ?>
<?php
if (isset($_POST['loop'])) {
    echo 123;
}
?>
<?php $form = ActiveForm::begin([
    'options' => [
        'data-pjax' => true,
    ],
    'action' => \yii\helpers\Url::to('/shop/ajax/test'),
]); ?>
<input type="text" name="test"/>
<input type="submit"/>
<?php ActiveForm::end(); ?>
<?php \yii\widgets\Pjax::end(); ?>
