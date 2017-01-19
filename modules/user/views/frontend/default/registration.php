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
<?= $form->errorSummary($data->getModel()); ?>
<?= $form->field($data->getModel(), 'login'); ?>
<?= $form->field($data->getModel(), 'email'); ?>
<?= $form->field($data->getModel(), 'password')->passwordInput(); ?>
<?= $form->field($data->getModel(), 'password_repeat')->passwordInput(); ?>
<?= $form->field($data->getModel(), 'verifyCode')->widget(\yii\captcha\Captcha::className(), [
    'captchaAction' => '/user/default/captcha',
]); ?>
<?php $form->end(); ?>
<?php \yii\widgets\Pjax::end(); ?>
