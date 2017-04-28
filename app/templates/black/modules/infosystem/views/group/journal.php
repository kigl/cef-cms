<?php
use yii\widgets\ListView;
use yii\helpers\Html;

$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<div class="content">
    <div class="container journal-group">
        <div class="row">
            <div class="col-md-12">
                <div class="journal-group-block text-center">
                    <h1 class="journal-group__header"><?= Html::encode($data['model']->name); ?></h1>
                    <?php if (!(Yii::$app->request->getQueryParam('page') > 1)) : ?>
                        <?php if ($data['model']->getBehavior('imageContent')->fileExist()) : ?>
                            <img src="<?= $data['model']->getBehavior('imageContent')->getFileUrl(); ?>" alt=""
                                 class="journal-group__image">
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row margin-top-20">
            <div class="col-md-12">
                <?= ListView::widget([
                    'itemView' => '_journal',
                    'options' => ['class' => 'journal-article-list'],
                    'itemOptions' => function ($model, $key, $index, $widget) {
                        if ($index % 2 == 0) {
                            return ['class' => 'left', 'tag' => 'article'];
                        } else {
                            return ['class' => 'right', 'tag' => 'article'];
                        }
                    },
                    'summaryOptions' => ['class' => 'margin-bottom-10 text-right'],
                    'dataProvider' => $data['dataProvider'],
                    'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
                    'sorter' => ['options' => ['class' => 'list-inline panel'],],
                ]); ?>
            </div>
        </div>
        <hr class="margin-top-50 margin-bottom-50"/>
        <div class="row">
            <div class="col-md-12">
                <?php if (!(Yii::$app->request->getQueryParam('page') > 1)) : ?>
                    <article class="journal-group__content">
                        <?= $data['model']->content; ?>
                    </article>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>