<?php
use yii\helpers\Html;
\app\modules\shop\widgets\frontend\cart\asset\Asset::register($this);
?>

<?php \yii\widgets\Pjax::begin(['id' => 'cart-pjax']); ?>

<?php
//var_dump($data->cartCookie->getRequestValue());
?>

<div class="cart-block panel panel-default">
    <div class="panel-heading">
        <?= Html::a('Корзина', $urlPageCart, ['data-pjax' => 0]);?>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12"><span class="badge"><?= $data->getCount(); ?></span></div>
                </div>
                <div class="row">
                    <div class="col-md-12"><?= Yii::$app->formatter->asCurrency($data->getSum()); ?></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php \yii\widgets\Pjax::end(); ?>
