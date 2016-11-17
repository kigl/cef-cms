<?php
use app\modules\frontend\widgets\ActiveForm;

$this->setPageHeader('Аутентификация пользователя');
?>

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><?= Yii::t('user', 'Authenticate'); ?></div>
            <div class="panel-body">
                <?php $form = ActiveForm::begin([
                ]); ?>
                <?php echo $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>
                <?php echo $form->field($model, 'login'); ?>
                <?php echo $form->field($model, 'password')->passwordInput(); ?>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
</div>