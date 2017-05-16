<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->setTitle('Аутентификация пользователя');
?>

    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">Logo</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"><?= Yii::t('user', 'Authenticate'); ?></p>

            <?php $form = ActiveForm::begin([
                'enableAjaxValidation' => true,
                'validateOnChange' => false,
                'validateOnBlur' => false,
            ]); ?>
            <?= $form->field($data['form'], 'login'); ?>
            <?= $form->field($data['form'], 'password')
                ->passwordInput(); ?>

            <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary']) ?>

            <?php $form->end(); ?>

        </div>
    </div>