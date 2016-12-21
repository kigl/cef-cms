<?php
use yii\helpers\Url;

?>

<div class="product-item">
    <div class="row">
        <div class="col-md-12">
            <div class="product-main-image">
                <a href="<?= Url::to($model->getUrl()); ?>">
                    <?= \app\modules\shop\widgets\frontend\mainImage\Widget::widget(['model' => $model->mainImage]); ?>
                </a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h3><?= $model->name; ?></h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="product-price">
                <?= $model->price; ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 product-action">
            <input type="text" id="count_<?= $model->id?>" name="toCart[<?= $model->id;?>]"/>
            <a href="#" onclick="addToCart(<?= $model->id;?>,  document.getElementById('<?= 'count_' . $model->id;?>').value)">press</a>
        </div>
    </div>
</div>
