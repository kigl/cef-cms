<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;

$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<div class="content">
    <div class="container">
        <div class="journal-article">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1 class="jpurnal-article__header"><?= Html::encode($this->getPageHeader()); ?></h1>
                    </div>
                    <ul class="list-inline">
                        <li>
                            <b><?= Yii::$app->formatter->asDate($data['model']->date, 'long'); ?></b>
                        </li>
                        <li>
                            <?= \app\modules\infosystems\widgets\ListTags::widget([
                                'tags' => $data['model']->tags,
                                'infosystemId' => $data['model']->infosystem_id
                            ]) ?>
                        </li>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($data['model']->getBehavior('imageContent')->fileExist()) : ?>
                        <img src="<?= $data['model']->getBehavior('imageContent')->getFileUrl(); ?>" style="width: 100%"
                             class="journal-article__image"/>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $data['model']->content; ?>
                </div>
            </div>

            <?= app\modules\infosystems\widgets\SimilarItem::widget([
                'infosystemId' => $data['model']->infosystem_id,
                'currentItemId' => $data['model']->id,
                'headerText' => 'Похожие статьи',
                'headerTag' => 'div',
                'dateOptions' => ['class' => 'strong'],
                'headerOptions' => ['class' => 'col-md-12 h4'],
                'tagsId' => ArrayHelper::getColumn($data['model']->itemTags, 'tag_id'),
                'imageOptions' => ['style' => 'width: 100%;'],
            ]) ?>
        </div>
    </div>
</div>