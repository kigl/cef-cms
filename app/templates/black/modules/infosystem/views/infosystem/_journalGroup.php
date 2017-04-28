<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-6 margin-bottom-30">
    <div class="journal-group-block text-center">
        <a href="<?= Url::to([
            '/infosystem/group/view',
            'id' => $model->id,
            'infosystem_id' => $model->infosystem_id,
            'alias' => $model->alias
        ]) ?>">
            <h2 class="journal-group__header">
                <?= Html::encode($model->name); ?>
            </h2>
            <?php if ($model->getBehavior('imagePreview')->fileExist()) : ?>
                <img src="<?= $model->getBehavior('imagePreview')->getFileUrl(); ?>" alt=""
                     class="journal-group__image">
            <?php endif; ?>
        </a>
    </div>
</div>