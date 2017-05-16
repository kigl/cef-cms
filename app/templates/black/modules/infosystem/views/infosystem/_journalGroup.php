<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-6 margin-bottom-30">
    <div class="journal-group-block text-center">
        <a href="<?= $model->getModelItemUrl(); ?>">
            <h2 class="journal-group__header">
                <?= Html::encode($model->name); ?>
            </h2>
            <?php if ($model->getBehavior('imageDescription')->fileExist()) : ?>
                <img src="<?= $model->getBehavior('imageDescription')->getFileUrl(); ?>" alt=""
                     class="journal-group__image">
            <?php endif; ?>
        </a>
    </div>
</div>