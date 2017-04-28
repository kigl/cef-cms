<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="col-md-3">
    <h2>
        <a href="<?= Url::to([
            '/infosystem/item/view',
            'id' => $model->id,
            'alias' => $model->alias,
            'infosystem_id' => $model->infosystem_id
        ]) ?>">
            <?= Html::encode($model->name); ?>
        </a>
    </h2>
    <div class="img-thumbnail">
        <?php if ($model->getBehavior('imagePreview')->fileExist()) : ?>
            <img src="<?= $model->getBehavior('imagePreview')->getFileUrl(); ?>" style="width: 100%"/>
        <?php endif; ?>
    </div>
</div>