<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<div class="product-item img-thumbnail">
    <div class="row">
        <div class="col-md-12"><?= $model->id; ?></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="product-main-image">
                <a href="<?= Url::to($model->getUrl()); ?>" data-pjax="0">
                    <?= \app\modules\shop\widgets\frontend\mainImage\Widget::widget(['model' => $model->mainImage]); ?>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3><?=Html::encode($model->name);?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="product-price">
                <?= Yii::t('shop', 'Price: {price, number, currency}', ['price' => $model->price]); ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?= Url::to($model->getUrl()); ?>" class="show-in-modal">
                <?= Yii::t('shop', 'Quick view product');?>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 product-action">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" id="count_<?= $model->id ?>" class="form-control"/>
                </div>
                <div class="col-md-6">
                    <a href="#"
                       onclick="addToCart(<?= $model->id; ?>,  document.getElementById('<?= 'count_' . $model->id; ?>').value); return false;" class="btn btn-primary btn-sm"><?= Yii::t('shop', 'Button add to cart');?></a>
                </div>
            </div>
        </div>
    </div>
</div>
