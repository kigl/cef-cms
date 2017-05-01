<?php
use app\modules\backend\widgets\ActiveForm;
use app\modules\backend\widgets\fileInput\Widget as ActionImage;

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
        <li><a href="#field" data-toggle="tab"><?= Yii::t('app', 'Tab properties'); ?></a></li>
        <li><a href="#role" data-toggle="tab"><?= Yii::t('user', 'Tab role'); ?></a></li>
    </ul>

<?php $form = ActiveForm::begin([
    'id' => 'form',
    'options' => ['enctype' => 'multipart/form-data'],
    'enableClientValidation' => false
]); ?>

    <div class="tab-content well well-sm">

        <?= $form->errorSummary(array_merge($data['userProperties'], [$data['model']])); ?>

        <div class="tab-pane active" id="main">
            <?= $form->field($data['model'], 'login'); ?>
            <?= $form->field($data['model'], 'status')
                ->dropDownList($data['model']->getStatusList()); ?>

            <?= $form->field($data['model'], 'email'); ?>

            <?= $form->field($data['model'], 'password')->passwordInput(['value' => '']); ?>
            <?= $form->field($data['model'], 'password_repeat')->passwordInput(['value' => '']); ?>
        </div>

        <div class="tab-pane" id="profile">
            <?= $form->field($data['model'], 'avatar')->widget(ActionImage::className(), [
                'behaviorName' => 'avatarUpload',
            ]); ?>
            <?= $form->field($data['model'], 'surname'); ?>
            <?= $form->field($data['model'], 'name'); ?>
            <?= $form->field($data['model'], 'lastname'); ?>
        </div>

        <div class="tab-pane" id="field">
            <?php foreach ($data['userProperties'] as $property) : ?>
                <?= $form->field($property, '[' . $property->property_id . ']value')
                    ->label($data['properties'][$property->property_id]->name); ?>
            <?php endforeach; ?>
        </div>

        <div class="tab-pane" id="role">
            <?= $form->field($data['model'], 'rolePermission')
                ->dropDownList($data['model']->getListRoleItem(), [
                    'prompt' => Yii::t('app', 'Not selected'),
                    'size' => 10,
                    'multiple' => 'multiple',
                    'groups' => [
                        '1' => ['label' => Yii::t('app', 'Type role')],
                        '2' => ['label' => Yii::t('app', 'Type permission')]
                    ],
                ]); ?>
        </div>
    </div>
<?php $form->end(); ?>