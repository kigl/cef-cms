<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->setTitle('Аутентификация пользователя');
?>

<?php Pjax::begin([
    'enablePushState' => false,
    'id' => 'user-auth'
]); ?>
    <div class="login-box">
        <div class="login-logo">
            <a href="../../index2.html">Logo</a>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg"><?= Yii::t('user', 'Authenticate'); ?></p>

            <?php $form = ActiveForm::begin([
                'options' => ['data-pjax' => true],
            ]); ?>
            <?= $form->errorSummary($data['form'], ['class' => 'alert alert-danger']); ?>
            <?= $form->field($data['form'], 'login'); ?>
            <?= $form->field($data['form'], 'password')
                ->passwordInput(); ?>

            <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary']) ?>

            <?php $form->end(); ?>

        </div>
    </div>
<?php Pjax::end(); ?>