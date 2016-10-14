<?php
use yii\jui\DatePicker;
use app\modules\admin\widgets\ActiveForm;
use vova07\imperavi\Widget;

$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'informationsystem_id')->hiddenInput(['value' => $informationsystem_id])->label(false);?>
<?= $form->field($model, 'parent_id')->hiddenInput(['value' => $parent_id])->label(false);?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'name');?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'image')->fileInput();?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'sort');?>
        </div>
    </div>


<?= $form->field($model, 'description')->textArea();?>

<?= $form->field($model, 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]);?>

<?= $form->field($model, 'alias');?>

<?= $form->field($model, 'meta_title');?>

<?= $form->field($model, 'meta_description')->textArea();?>

<?php ActiveForm::end();?>