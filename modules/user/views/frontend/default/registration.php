<?php
$this->setPageHeader('Регистрация');
?>
<?php \yii\widgets\Pjax::begin([
    'id' => 'user-registration',
    'enablePushState' => false,
]); ?>
<?php $form = \app\modules\frontend\widgets\ActiveForm::begin([
    'options' => [
        'data-pjax' => true,
    ],
]); ?>
<?= $form->errorSummary($model); ?>
<?php echo $form->field($model, 'login'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'password')->passwordInput(); ?>
<?php echo $form->field($model, 'password_repeat')->passwordInput(); ?>
<?= $form->field($model, 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
    'captchaAction' => '/user/default/captcha',
]); ?>
<?php $form->end(); ?>
<?php \yii\widgets\Pjax::end(); ?>
