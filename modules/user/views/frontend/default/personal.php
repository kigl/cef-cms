<?php
use app\modules\frontend\widgets\ActiveForm;

$this->setPageHeader('Личный кабинет');
?>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#main" data-toggle="tab">
                    <?= Yii::t('user', 'Tab main data'); ?>
                </a>
            </li>
            <li>
                <a href="#personal" data-toggle="tab">
                    <?= Yii::t('user', 'Tab personal data'); ?>
                </a>
            </li>
            <li>
                <a href="#property" data-toggle="tab">
                    <?= Yii::t('user', 'Tab property'); ?>
                </a>
            </li>
        </ul>
    </div>
</div>
<?php $form = ActiveForm::begin(); ?>
<?= $form->errorSummary($data->getModel()); ?>
<div class="tab-content">
    <div class="tab-pane active" id="main">
        <?= $form->field($data->getModel(), 'login'); ?>
        <?= $form->field($data->getModel(), 'email'); ?>
        <?= $form->field($data->getModel(), 'password')->passwordInput(['value' => '']); ?>
        <?= $form->field($data->getModel(), 'password_repeat')->passwordInput(['value' => '']); ?>
    </div>
    <div class="tab-pane" id="personal">
        <?= $form->field($data->getModel(), 'surname'); ?>
        <?= $form->field($data->getModel(), 'name'); ?>
        <?= $form->field($data->getModel(), 'lastname'); ?>
    </div>
    <div class="tab-pane" id="property">
        <?php foreach ($data->getFields() as $fi) : ?>
            <?= $form->field($fi, '[' . $fi->field_id . ']value')->label($fi->field->name); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php $form->end(); ?>
