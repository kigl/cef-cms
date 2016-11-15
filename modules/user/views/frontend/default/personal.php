<?php
use app\modules\frontend\widgets\ActiveForm;

?>

<div class="row">
    <div class="col-md-12">
        <ul class="nav nav-tabs">
            <li class="active">
                <a href="#main" data-toggle="tab">
                    <?= Yii::t('user', 'Main data'); ?>
                </a>
            </li>
            <li>
                <a href="#profile" data-toggle="tab">
                    <?= Yii::t('user', 'Profile'); ?>
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
    <div class="tab-pane" id="profile">
        <?= $form->field($model, 'surname'); ?>
        <?= $form->field($model, 'name'); ?>
        <?= $form->field($model, 'lastname'); ?>
        <?php foreach ($field as $fi) : ?>
            <?= $form->field($fi, '[' . $fi->field_id . ']value')->label($fi->field->name); ?>
        <?php endforeach; ?>
    </div>
</div>
<?php $form->end(); ?>
