<?php
use yii\helpers\Html;
use app\modules\admin\widgets\ActiveForm;
use app\modules\user\models\User;

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
        <li><a href="#field" data-toggle="tab"><?= Yii::t('user', 'Tab field');   ?></a></li>
    </ul>

<?php $form = ActiveForm::begin(['id' => 'form']); ?>

    <div class="tab-content well well-sm">
        <div class="tab-pane active" id="main">
            <?php echo $form->errorSummary($model, ['class' => 'alert alert-danger']); ?>
            <?php echo $form->field($model, 'login'); ?>
            <?php echo $form->field($model, 'status')->dropDownList(User::getStatusList()); ?>
            <?php echo $form->field($model, 'email'); ?>

            <?php echo $form->field($model, 'password')->passwordInput(['views' => '']); ?>
            <?php echo $form->field($model, 'password_repeat')->passwordInput(['views' => '']); ?>
        </div>

        <div class="tab-pane" id="profile">
            <?php echo $form->field($model, 'surname'); ?>
            <?php echo $form->field($model, 'name'); ?>
            <?php echo $form->field($model, 'lastname'); ?>
        </div>

        <div class="tab-pane" id="field">
            <?php foreach ($field as $fr) : ?>
                <?= $form->field($fr, '[' . $fr->field_id . ']views')->label($fr->field->name); ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php $form->end(); ?>