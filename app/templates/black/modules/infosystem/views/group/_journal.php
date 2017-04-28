<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>

<div class="row">
    <div class="col-md-6 journal-content">
        <h2 class="journal-article__header margin-top-40">
            <?= Html::a($model->name, [
                '/infosystem/item/view',
                'id' => $model->id,
                'alias' => $model->alias,
                'infosystem_id' => $model->infosystem_id
            ]) ?>
        </h2>
        <p><b><?= Yii::$app->formatter->asDate($model->date, 'long'); ?></b></p>
        <p class="journal-article__description"><?= $model->description; ?></p>
    </div>
    <div class="col-md-6 journal-image">
        <?php if ($model->getBehavior('imagePreview')->fileExist()) : ?>
            <a href="<?= Url::to([
                '/infosystem/item/view',
                'id' => $model->id,
                'alias' => $model->alias,
                'infosystem_id' => $model->infosystem_id
            ]) ?>">
                <img src="<?= $model->getBehavior('imagePreview')->getFileUrl(); ?>" style="width: 100%"
                     class="journal-article__image"/>
            </a>
        <?php endif; ?>
    </div>
</div>
