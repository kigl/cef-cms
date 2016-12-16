<?php
use yii\helpers\Url;

?>

<div>
    <a href="<?= Url::to($model->getUrl()); ?>">
        <div class="row">
            <div class="col-md-12">
                <div class="product-main-image">
                    <?php if ($model->mainImage) : ?>
                        <img src="<?= $model->mainImage->getFileUrl(); ?>" style="width: 100%;"/>
                    <?php else : ?>
                        <div class="text-center bold">@todo not image</div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h3><?= $model->name ?></h3>
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
