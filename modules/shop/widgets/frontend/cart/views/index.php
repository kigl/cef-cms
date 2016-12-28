<?php
\app\modules\shop\widgets\frontend\cart\asset\Asset::register($this);
?>

<?php \yii\widgets\Pjax::begin(['id' => 'cart-pjax']); ?>

<div class="cart-block panel panel-default">
    <div class="panel-heading">
        Корзина
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12"><?= $data->getCount(); ?></div>
                </div>
                <div class="row">
                    <div class="col-md-12"><?= Yii::$app->formatter->asCurrency($data->getSum()); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php \yii\widgets\Pjax::end(); ?>
