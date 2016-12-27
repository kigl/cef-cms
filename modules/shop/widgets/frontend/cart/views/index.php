<?php
\app\modules\shop\widgets\frontend\cart\asset\Asset::register($this);
?>

<?php \yii\widgets\Pjax::begin(['id' => 'cart-pjax']); ?>

<div class="cart-block">
    <div class="row">
        <div class="col-md-6">
            <i class="glyphicon glyphicon-shopping-cart cart-ico"></i>
        </div>
        <div class="col-md-6">
            <div class="row">
                <div class="col-md-12"><?= $data->getCount(); ?></div>
            </div>
            <div class="row">
                <div class="col-md-12"><?= $data->getSum(); ?></div>
            </div>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end(); ?>
