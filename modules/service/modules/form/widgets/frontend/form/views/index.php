<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use app\modules\service\modules\form\models\Field;

?>

<div class="panel panel-default">
    <div class="panel-heading"><?= Html::encode($data['model']->description); ?></div>
    <?php $form = ActiveForm::begin([
        'enableClientValidation' => false,
    ]); ?>
    <div class="panel-body">
        <?= $form->errorSummary($data['model']->fields, ['class' => 'alert alert-danger']); ?>

        <?php foreach ($data['fields'] as $key => $field) : ?>

            <?php if ($data['model']->fields[$key]->type === Field::FIELD_TYPE_TEXT) : ?>
                <?= $form->field($field, '[' . $key . ']value')
                    ->textInput(['placeholder' => $data['model']->fields[$key]->description])
                    ->label($data['model']->fields[$key]->name); ?>

            <?php elseif ($data['model']->fields[$key]->type === Field::FIELD_TYPE_CHECKBOX) : ?>
                <?= $form->field($field, '[' . $key . ']value')
                    ->checkbox(['label' => $data['model']->fields[$key]->description]); ?>
            <?php endif; ?>

        <?php endforeach; ?>
    </div>
    <div class="panel-footer">
        <?= Html::submitButton(Yii::t('app', 'Submit send'), ['class' => 'btn btn-primary btn-sm']); ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>