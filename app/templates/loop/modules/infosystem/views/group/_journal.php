<?php
use yii\helpers\Html;
use app\modules\infosystem\widgets\ListTags;

?>

<div class="row">
    <div class="col-md-6 journal-content">
        <div class="margin-top-20 padding-10">
            <h2 class="journal-article__header">
                <a href="<?= $model->getModelItemUrl(); ?>"><?= Html::encode($model->name); ?></a>
            </h2>
            <div>
                <ul class="list-inline">
                    <li>
                        <b><?= Yii::$app->formatter->asDate($model->date, 'long'); ?></b>
                    </li>
                    <li>
                        <?= ListTags::widget(['tags' => $model->tags, 'infosystemId' => $model->infosystem_id]); ?>
                    </li>
                </ul>
            </div>
            <p class="journal-article__description"><?= $model->description; ?></p>
        </div>
    </div>
    <div class="col-md-6 journal-image">
        <?php if ($model->getBehavior('imageDescription')->fileExist()) : ?>
            <a href="<?= $model->getModelItemUrl(); ?>">
                <img src="<?= $model->getBehavior('imageDescription')->getFileUrl(); ?>" style="width: 100%"
                     class="journal-article__image"/>
            </a>
        <?php endif; ?>
    </div>
</div>
