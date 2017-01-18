<?php
use app\modules\admin\widgets\ActiveForm;
use app\modules\user\helpers\StatusHelper;

?>
    <ul class="nav nav-tabs">
        <li class="active">
            <a href="#main" data-toggle="tab">
                <?= Yii::t('user', 'Main data'); ?>
            </a>
        </li>
        <li>
            <a href="#profile" data-toggle="tab">
                <?= Yii::t('user', 'Profile'); ?>
            </a>
        </li>
        <li><a href="#field" data-toggle="tab"><?= Yii::t('user', 'Tab field'); ?></a></li>
        <li><a href="#role" data-toggle="tab"><?= Yii::t('user', 'Tab role');?></a></li>
    </ul>

<?php $form = ActiveForm::begin(['id' => 'form']); ?>

    <div class="tab-content well well-sm">

        <?php echo $form->errorSummary($data->getModel(), ['class' => 'alert alert-danger']); ?>

        <div class="tab-pane active" id="main">
            <?php echo $form->field($data->getModel(), 'login'); ?>
            <?php echo $form->field($data->getModel(), 'status')
                ->dropDownList(StatusHelper::getList()); ?>

            <?php echo $form->field($data->getModel(), 'email'); ?>

            <?php echo $form->field($data->getModel(), 'password')->passwordInput(['value' => '']); ?>
            <?php echo $form->field($data->getModel(), 'password_repeat')->passwordInput(['value' => '']); ?>
        </div>

        <div class="tab-pane" id="profile">
            <?php echo $form->field($data->getModel(), 'surname'); ?>
            <?php echo $form->field($data->getModel(), 'name'); ?>
            <?php echo $form->field($data->getModel(), 'lastname'); ?>
        </div>

        <div class="tab-pane" id="field">
            <?php foreach ($data->getFieldModels() as $fr) : ?>
                <?= $form->field($fr, '[' . $fr->field_id . ']value')->label($fr->field->name); ?>
            <?php endforeach; ?>
        </div>

        <div class="tab-pane" id="role">
            <?= $form->field($data->getModel(), 'rolePermission')
                ->dropDownList($data->getauthItemList(), ['multiple' => 'multiple', 'size' => 15, 'prompt' => '']);?>
        </div>
    </div>
<?php $form->end(); ?>