<?php
use app\modules\frontend\widgets\ActiveForm;

?>

<div class="row">
    <div class="col-md-offset-2 col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading"><?= Yii::t('user', 'Authenticate'); ?></div>
            <?php $form = ActiveForm::begin([
            ]); ?>
            <div class="panel-body">
                <?php echo $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>
                <?php echo $form->field($model, 'login'); ?>
                <?php echo $form->field($model, 'password')->passwordInput(); ?>
            </div>
            <?php $form->end(); ?>
        </div>
    </div>
</div>