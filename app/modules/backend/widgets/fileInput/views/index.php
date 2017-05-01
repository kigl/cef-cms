<?php
use kartik\file\FileInput;

?>
<?php if ($model->getBehavior($widget->behaviorName)->fileExist()) : ?>
    <div>
        <div class="img-thumbnail">
            <div>
                <div class="pull-right">
                    <label>
                        Удалить <input type="checkbox"
                                       name="<?= $model->getBehavior($widget->behaviorName)->getDeleteKey() ?>">
                    </label>
                </div>
            </div>
            <a href="<?= $model->getBehavior($widget->behaviorName)->getFileUrl(); ?>">
                <?php if (getimagesize($model->getBehavior($widget->behaviorName)->getFilePath())) : ?>
                    <img src="<?= $model->getBehavior($widget->behaviorName)->getFileUrl() ?>" style="width: 200px">
                <?php else : ?>
                    <?= $model->getBehavior($widget->behaviorName)->getOwnerAttribute(); ?>
                <?php endif; ?>
            </a>
        </div>
    </div>
    <br/>
<?php endif; ?>

<?= FileInput::widget([
    'model' => $model,
    'attribute' => $attribute,
]) ?>


