<?php
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
use yii\captcha\Captcha;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
use app\modules\form\models\Field;
use app\modules\form\widgets\form\Widget;
use app\modules\lists\widgets\DropDownItems;
use app\modules\lists\widgets\RadioListItems;

?>

<?php
if ($data['widget']->pjax) {
    Pjax::begin([
        'id' => 'form_' . $data['model']->id,
        'enablePushState' => false
    ]);
} ?>

<?php $form = ActiveForm::begin([
    'layout' => $data['widget']->layout,
    'fieldConfig' => $data['widget']->fieldConfig,
    'enableClientValidation' => false,
    'options' => ArrayHelper::merge($data['widget']->options, ['data-pjax' => true]),
]); ?>
    <div class="panel panel-default">
        <div class="panel-heading"><?= Html::encode($data['model']->name); ?></div>
        <div class="panel-body">
            <p class="panel-description"><?= Html::encode($data['model']->description); ?></p>

            <?php if (Yii::$app->session->hasFlash(Widget::FLASH_FORM_COMPLETED)) : ?>
                <div class="alert alert-success">
                    <?= Yii::$app->session->getFlash(Widget::FLASH_FORM_COMPLETED); ?>
                </div>
            <?php endif; ?>

            <?= $form->errorSummary($data['fields'], ['class' => 'alert alert-danger']); ?>

            <?php foreach ($data['groupFields'] as $group) : ?>
                <?php foreach ($group as $name => $fields) : ?>
                    <?php ksort($fields); ?>
                    <?php if ($name != 'none') : ?>
                        <fieldset>
                        <legend><?= $name; ?></legend>
                    <?php endif; ?>

                    <?php foreach ($fields as $key => $field) : ?>
                        <?php foreach ($field as $index => $f) : ?>
                            <?php if ($index !== 'captcha') : ?>
                                <?php if ($f->type === Field::TYPE_TEXT) : ?>
                                    <?= $form->field($data['fields'][$index], '[' . $index . ']value')
                                        ->textInput(['placeholder' => $f->description])
                                        ->label($f->name); ?>

                                <?php elseif ($f->type === Field::TYPE_TEXTAREA) : ?>
                                    <?= $form->field($data['fields'][$index], '[' . $index . ']value')
                                        ->textarea(['placeholder' => $f->description])
                                        ->label($f->name); ?>

                                <?php elseif ($f->type === Field::TYPE_CHECKBOX) : ?>
                                    <?= $form->field($data['fields'][$index], '[' . $index . ']value')
                                        ->checkbox(['label' => $f->description]); ?>

                                <?php elseif ($f->type === Field::TYPE_RADIO) : ?>
                                    <?= $form->field($data['fields'][$index], '[' . $index . ']value')
                                        ->widget(RadioListItems::className(), ['listId' => $f->list_id])
                                        ->label($f->name); ?>

                                <?php elseif ($f->type === Field::TYPE_SELECT) : ?>
                                    <?= $form->field($data['fields'][$index], '[' . $index . ']value')
                                        ->widget(DropDownItems::className(), ['listId' => $f->list_id])
                                        ->label($f->name); ?>
                                <?php endif; ?>

                            <?php endif; ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>

                    <?php if ($name != 'none') : ?>
                        </fieldset>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endforeach; ?>

            <?php if (array_key_exists('captcha', $data['fields'])) : ?>
                <?= $form->field($data['fields']['captcha'], '[captcha]verifyCode')
                    ->label(Yii::t('app', 'Captcha'))
                    ->widget(Captcha::className(), [
                        'captchaAction' => '/form/site/captcha',
                        'options' => ['value' => '', 'class' => 'form-control'],
                    ]); ?>
            <?php endif; ?>

        </div>
        <div class="panel-footer">
            <?= Html::submitButton(Yii::t('app', 'Submit send'), ['class' => 'btn btn-primary btn-sm']); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>

<?php
if ($data['widget']->pjax) {
    Pjax::end();
} ?>