<?php
use yii\helpers\Html;
?>

<div class="col-md-4 product img-thumbnail">
    <div>image</div>
    <div class="h4 name"><?= Html::a(Html::encode($model->name), ['/shop/product/view', 'id' => $model->id]);?></div>
    <div class="price"><?= $model->price;?></div>
</div>
