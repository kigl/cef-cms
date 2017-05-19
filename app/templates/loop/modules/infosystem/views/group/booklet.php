<?php
use yii\helpers\Html;

$this->setTitle('Буклет: ' . $data['model']->meta_title);
$this->setMetaDescription($data['model']->meta_description);
$this->setPageHeader($data['model']->name);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

\app\widgets\flipBookSlide\Asset::register($this);
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
                <?= \app\widgets\flipBookSlide\Widget::widget(['model' => $data['model']]) ?>
            </div>
        </div>
    </div>
</div>
