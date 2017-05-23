<?php
use yii\helpers\Html;

$this->setTitle($model->meta_title);
$this->setMetaDescription($model->meta_description);
$this->setPageHeader($model->name);
$this->params['breadcrumbs'][] = ['label' => $model->name];
?>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h1><?= Html::encode($this->getPageHeader()); ?></h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?= $model->content; ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <?php
                if (is_file($model->getDynamicDataFilePathUrl())) {
                    echo $this->renderFile($model->getDynamicDataFilePathUrl());
                }
                ?>
            </div>
        </div>
    </div>
</div>