<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\user\helpers\StatusHelper;

?>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#main" data-toggle="tab">
                <?= Yii::t('app', 'Tab main'); ?>
            </a>
        </li>
        <li>
            <a href="#profile" data-toggle="tab">
                <?= Yii::t('app', 'Tab profile'); ?>
            </a>
        </li>
        <li><a href="#field" data-toggle="tab"><?= Yii::t('app', 'Tab more properties'); ?></a></li>
        <li><a href="#role" data-toggle="tab"><?= Yii::t('user', 'Tab role');?></a></li>
    </ul>

<?php $form = ActiveForm::begin(['id' => 'form']); ?>

    <div class="tab-content well well-sm">

        <?php echo $form->errorSummary($data['model'], ['class' => 'alert alert-danger']); ?>

        <div class="tab-pane active" id="main">
            <?php echo $form->field($data['model'], 'login'); ?>
            <?php echo $form->field($data['model'], 'status')
                ->dropDownList($data['model']->getStatusList()); ?>

            <?php echo $form->field($data['model'], 'email'); ?>

            <?php echo $form->field($data['model'], 'password')->passwordInput(['value' => '']); ?>
            <?php echo $form->field($data['model'], 'password_repeat')->passwordInput(['value' => '']); ?>
        </div>

        <div class="tab-pane" id="profile">
            <?php echo $form->field($data['model'], 'surname'); ?>
            <?php echo $form->field($data['model'], 'name'); ?>
            <?php echo $form->field($data['model'], 'lastname'); ?>
        </div>

        <div class="tab-pane" id="field">
            <?php foreach ($data['fields'] as $fr) : ?>
                <?= $form->field($fr, '[' . $fr->field_id . ']value')->label($fr->field->name); ?>
            <?php endforeach; ?>
        </div>

        <div class="tab-pane" id="role">
            <?= $form->field($data['model'], 'rolePermission')
                ->dropDownList($data['roleListItem'], [
                    'prompt' => Yii::t('app', 'Not selected'),
                    'size' => 10,
                    'multiple' => 'multiple',
                    'groups' => [
                        '1' => ['label' => Yii::t('app', 'Type role')],
                        '2' => ['label' => Yii::t('app', 'Type permission')]
                    ],
                ]);?>
        </div>
    </div>
<?php $form->end(); ?>