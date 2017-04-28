<?php
use yii\helpers\Html;

$this->setTitle($data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<div class="content">
    <div class="container">
        <article>
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1 class=""><?= Html::encode($this->getPageHeader()); ?></h1>
                    </div>
                    <p><b><?= Yii::$app->formatter->asDate($data['model']->date, 'long'); ?></b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($data['model']->getBehavior('imagePreview')->fileExist()) : ?>
                        <img src="<?= $data['model']->getBehavior('imagePreview')->getFileUrl(); ?>"/>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $data['model']->content; ?>
                </div>
            </div>
        </article>
    </div>
</div>