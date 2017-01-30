<?php
use yii\helpers\Html;
use vova07\imperavi\Widget;
use app\modules\backend\widgets\ActiveForm;
use app\modules\backend\widgets\imageInForm\Widget as ImageInForm;

?>

<?php $form = ActiveForm::begin(); ?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->field($model, 'name'); ?>

<?php echo $form->field($model, 'description')->textArea(); ?>

<?php echo $form->field($model, 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]); ?>

<?php ActiveForm::end(); ?>