<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\icons\Icon;

$this->setPageHeader('Аутентификация пользователя');
?>

<?php Pjax::begin([
    'enablePushState' => false,
    'id' => 'user-auth'
]); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading"><?= Yii::t('user', 'Authenticate'); ?></div>
                <?php $form = ActiveForm::begin([
                    'type' => ActiveForm::TYPE_VERTICAL,
                    'options' => ['data-pjax' => true],
                ]); ?>
                <div class="panel-body">
                    <?= $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>
                    <?= $form->field($model, 'login', [
                        'addon' => ['prepend' => ['content' => Icon::show('user')]],
                    ]); ?>
                    <?= $form->field($model, 'password', [
                            'addon' => ['prepend' => ['content' => Icon::show('lock')]]
                    ])
                        ->passwordInput(); ?>

                    <div class="form-group">
                        <?= Html::a(Yii::t('user', 'Forgot your password?'), ['/user/default/password-restore']); ?>
                    </div>
                </div>
                <div class="panel-footer">
                    <?= Html::submitButton('login') ?>
                </div>
                <?php $form->end(); ?>
            </div>
        </div>
    </div>
<?php Pjax::end(); ?>