<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->setTitle('Аутентификация пользователя');
?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <?= Yii::t('users', 'Authenticate'); ?>
                </div>
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'enableAjaxValidation' => true,
                        'validateOnChange' => false,
                        'validateOnBlur' => false,
                    ]); ?>
                    <?= $form->field($data['form'], 'login'); ?>
                    <?= $form->field($data['form'], 'password')
                        ->passwordInput(); ?>

                </div>
                <div class="panel-footer">
                    <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary']) ?>

                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
</div>
