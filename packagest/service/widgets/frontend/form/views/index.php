<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use kigl\cef\module\service\models\form\Field;
use yii\widgets\Pjax;

?>

<?php Pjax::begin([
        'id' => 'form_' . $data['model']->id,
        'enablePushState' => false
    ]); ?>

    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($data['model']->description); ?></div>
        <?php $form = ActiveForm::begin([
            'enableClientValidation' => false,
            'options' => ['data-pjax' => true],
        ]); ?>
        <div class="panel-body">

            <?php if (Yii::$app->session->hasFlash(\app\modules\service\modules\form\widgets\frontend\form\Widget::FLASH_FORM_COMPLETED)) :?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash(\app\modules\service\modules\form\widgets\frontend\form\Widget::FLASH_FORM_COMPLETED);?>
                </div>
            <?php endif;?>

            <?= $form->errorSummary($data['fields'], ['class' => 'alert alert-danger']); ?>

            <?php foreach ($data['fields'] as $key => $field) : ?>
                <?php if ($key !== 'captcha') : ?>
                    <?php if ($data['model']->fields[$key]->type === Field::FIELD_TYPE_TEXT) : ?>
                        <?= $form->field($field, '[' . $key . ']value')
                            ->textInput(['placeholder' => $data['model']->fields[$key]->description])
                            ->label($data['model']->fields[$key]->name); ?>

                    <?php elseif ($data['model']->fields[$key]->type === Field::FIELD_TYPE_CHECKBOX) : ?>
                        <?= $form->field($field, '[' . $key . ']value')
                            ->checkbox(['label' => $data['model']->fields[$key]->description]); ?>
                    <?php endif; ?>
                <?php endif; ?>

            <?php endforeach; ?>

            <?php if (array_key_exists('captcha', $data['fields'])) : ?>
                <?= $form->field($data['fields']['captcha'], '[captcha]verifyCode')
                    ->label('')
                    ->widget(Captcha::className(), [
                        'captchaAction' => '/frontend/site/captcha',
                        'options' => ['value' => '', 'class' => 'form-control'],
                    ]); ?>
            <?php endif; ?>

        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit send'), ['class' => 'btn btn-primary btn-sm']); ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
<?php Pjax::end(); ?>