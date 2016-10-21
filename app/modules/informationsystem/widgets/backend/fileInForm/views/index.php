<?php
use yii\helpers\Html;
?>

<?php if ($model->getBehavior($behaviorName)->fileExist()) : ?>
    <div class="img-thumbnail">
        <div class="pull-right">Удалить <input type="checkbox" name="<?= $deleteKey ?>"></div>
        <div><?= $model->getBehavior($behaviorName)->owner->{$model->getBehavior($behaviorName)->attribute}; ?></div>
    </div>
<?php endif; ?>
<?= Html::activeFileInput($model, $attribute);?>

