<?php
use yii\jui\DatePicker;
use app\modules\admin\widgets\ActiveForm;
use vova07\imperavi\Widget;

//$this->params['breadcrumbs'] = $breadcrumbs;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($data->getModel());?>

<?= $form->field($data->getModel(), 'informationsystem_id')->hiddenInput(['value' => $data->getInformationsystemId()])->label(false);?>
<?= $form->field($data->getModel(), 'parent_id')->hiddenInput(['value' => $data->getParentId()])->label(false);?>

    <div class="row">
        <div class="col-md-12">
            <?= $form->field($data->getModel(), 'name');?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($data->getModel(), 'image')->fileInput();?>
        </div>
        <div class="col-md-6">
            <?= $form->field($data->getModel(), 'sort');?>
        </div>
    </div>


<?= $form->field($data->getModel(), 'description')->textArea();?>

<?= $form->field($data->getModel(), 'content')->widget(Widget::className(), [
    'settings' => [
        'lang' => 'ru',
        'minHeight' => 400,
    ],
]);?>

<?= $form->field($data->getModel(), 'alias');?>

<?= $form->field($data->getModel(), 'meta_title');?>

<?= $form->field($data->getModel(), 'meta_description')->textArea();?>

<?php ActiveForm::end();?>