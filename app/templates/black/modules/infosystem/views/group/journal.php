<?php
use yii\helpers\Html;

$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<div class="content">
    <div class="container journal-group">
        <?php if (!(Yii::$app->request->getQueryParam('page') > 1)) : ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="journal-group-block text-center">
                        <h1 class="journal-group__header"><?= Html::encode($data['model']->name); ?></h1>
                        <?php if ($data['model']->getBehavior('imageContent')->fileExist()) : ?>
                            <img src="<?= $data['model']->getBehavior('imageContent')->getFileUrl(); ?>" alt=""
                                 class="journal-group__image">
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="row margin-top-20">
            <div class="col-md-12">
                <?= $this->render('_journalListView', ['data' => $data]); ?>
            </div>
        </div>
        <?php if (!(Yii::$app->request->getQueryParam('page') > 1)) : ?>
            <div class="row">
                <div class="col-md-12">
                    <article class="journal-group__content">
                        <?= $data['model']->content; ?>
                    </article>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>