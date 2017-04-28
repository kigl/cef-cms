<?php
use yii\helpers\Html;

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
                    <p><b><?= Yii::$app->formatter->asDate($data['model']->date, 'long');?></b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if ($data['model']->getBehavior('imagePreview')->fileExist()) : ?>
                        <img src="<?= $data['model']->getBehavior('imagePreview')->getFileUrl(); ?>" style="width: 100%"
                             class="journal-article__image"/>
                    <?php endif; ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <?= $data['model']->content; ?>
                </div>
            </div>
        </div>
    </div>
</div>