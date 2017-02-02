<?php
use yii\helpers\Html;
use yii\helpers\Url;

\app\modules\shop\widgets\frontend\checkedProductProperties\asset\Asset::register($this);

$this->registerJs("
$(function () {
    $('.property__item').click(function () {
        var url = $(this);
        $.ajax({
                                type: 'GET',
                                url: url.attr('data-link'),
                                success: function (data) {
            var product = $.parseJSON(data);
            $('.product-price').html(product.price);
            $('#productId').val(product.id);
        }
                            });
                        });
});
");
?>

<ul class="list-properties list-inline"><?= $model->properties[$propertyId]->property->name; ?>
    <li>
        <label>
            <?= Html::radio($radioName, true,
                [
                    'data-link' => Url::to(['/shop/product/get-value', 'id' => $model->id]),
                    'class' => 'property__item',
                ]); ?>
            <span><?= $model->properties[$propertyId]->value; ?></span>
        </label>
    </li>
    <?php foreach ($model->subProducts as $product) : ?>
        <li>
            <label>
                <?= Html::radio($radioName, false,
                    [
                        'data-link' => Url::to(['/shop/product/get-value', 'id' => $product->id]),
                        'class' => 'property__item',
                    ]); ?>
                <span><?= $product->properties[$propertyId]->value; ?></span>
            </label>
        </li>
    <?php endforeach; ?>
</ul>
