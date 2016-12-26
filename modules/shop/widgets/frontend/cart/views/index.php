<?php
\app\modules\shop\widgets\frontend\cart\asset\Asset::register($this);
?>

<?php \yii\widgets\Pjax::begin(['id' => 'cart-pjax']);?>
<?php
//var_dump(Yii::$app->cart->product->getCount());
echo "<pre>";
//print_r(Yii::$app->cart->product->getProductsSum());
print_r(Yii::$app->cart->cookie->getValue());
echo "<br/>";
print_r(Yii::$app->cart->product->getProductsSum());
echo "</pre>";
?>
<?php \yii\widgets\Pjax::end();?>
