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
<?= $form->errorSummary($model); ?>
<div class="tab-content">
    <div class="tab-pane active" id="main">
        <?= $form->field($model, 'login'); ?>
        <?= $form->field($model, 'email'); ?>
        <?= $form->field($model, 'password')->passwordInput(['value' => '']); ?>
        <?= $form->field($model, 'password_repeat')->passwordInput(['value' => '']); ?>
    </div>
    <div class="tab-pane" id="personal">
        <?= $form->field($model, 'surname'); ?>
        <?= $form->field($model, 'name'); ?>
        <?= $form->field($model, 'lastname'); ?>
    </div>
    <div class="tab-pane" id="property">
        <?php foreach ($field as $fi) : ?>
            <?= $form->field($fi, '[' . $fi->field_id . ']value')->label($fi->field->name); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php $form->end(); ?>
