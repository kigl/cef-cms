<?php
use app\modules\backend\widgets\ActiveForm;
use vova07\imperavi\Widget;

?>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#main" data-toggle="tab"><?= Yii::t('app', 'Tab main'); ?></a></li>
        <li><a href="#settings" data-toggle="tab"><?= Yii::t('app', 'Tab settings'); ?></a></li>
    </ul>

<?php $form = ActiveForm::begin(); ?>

<?php echo $form->errorSummary($model); ?>

    <div class="tab-content">
        <div class="tab-pane active" id="main">
            <?= $form->field($model, 'id'); ?>

            <?= $form->field($model, 'name'); ?>

            <?= $form->field($model, 'description')->textArea(); ?>

            <?= $form->field($model, 'content')->widget(Widget::className(), [
                'settings' => [
                    'lang' => 'ru',
                    'minHeight' => 400,
                ],
            ]); ?>
        </div>

        <div class="tab-pane" id="settings">
            <?= $form->field($model, 'template_group'); ?>

            <?= $form->field($model, 'template_item'); ?>

            <?= $form->field($model, 'item_on_page'); ?>
        </div>
    </div>
<?php ActiveForm::end(); ?>