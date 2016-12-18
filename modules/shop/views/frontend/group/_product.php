<?php
use yii\helpers\Url;
?>

<div>
    <a href="<?= Url::to($model->getUrl()); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="product-main-image">
                    <?= \app\modules\shop\widgets\frontend\mainImage\Widget::widget(['model' => $model->mainImage]);?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><?= $model->name;?></h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="product-price">
                    <?= $model->price; ?>
                </div>
            </div>
        </div>
    </a>
</div>
