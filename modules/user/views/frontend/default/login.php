<?php
use yii\widgets\Pjax;
use app\modules\frontend\widgets\ActiveForm;
use yii\helpers\Html;

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
                <div class="panel-body">
                    <?php $form = ActiveForm::begin([
                        'options' => [
                                'data-pjax' => true,
                        ],
                    ]); ?>
                    <?php echo $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>
                    <?php echo $form->field($model, 'login'); ?>
                    <?php echo $form->field($model, 'password')->passwordInput(); ?>

                    <div class="form-group">
                        <?= Html::a(Yii::t('user', 'Forgot your password?'), ['/user/default/password-restore']);?>
                    </div>

                    <?php $form->end(); ?>
                </div>
            </div>
        </div>
    </div>
<?php Pjax::end(); ?>