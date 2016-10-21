<?php
use yii\helpers\Html;
use vova07\imperavi\Widget;
use app\modules\admin\widgets\ActiveForm;
use app\modules\admin\widgets\imageInForm\Widget as ImageInForm;

?>

<?php $form = ActiveForm::begin(); ?>
<?php echo $form->errorSummary($model); ?>

<?php echo $form->field($model, 'name'); ?>

    <div class="row">
        <div class="col-md-6">
            <?= ImageInForm::widget(['model' => $model, 'attribute' => 'image']); ?>
            <?= $form->field($model, 'image')->fileInput(); ?>
        </div>

        <div class="col-md-6">
            <?php echo $form->field($model, 'status')->dropDownList($model->getStatusList()); ?>
        </div>
    </div>

<?php echo $form->field($model, 'description')->textArea(); ?>

<?php echo $form->field($model, 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]); ?>

<?= $form->field($model, 'items_per_page'); ?>

<?php ActiveForm::end(); ?>