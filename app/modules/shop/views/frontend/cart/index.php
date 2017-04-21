<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

$this->setPageHeader(Yii::t('shop', 'Page header cart'));
?>

<?php
/**
 * @todo
 * много в представлении всего
 */

$this->registerJs("
    $(function () {
        $('#refresh').click(function () {
            var grid = $('#grid-view');
            var array = [];

            grid.find(\"input[type='text']\").each(function () {
                array.push({'productId': $(this).attr('data-product'), 'qty': $(this).val()});
            });

            $.ajax({
                type: 'POST',
                url: '/shop/cart/refresh',
                data: $.extend({}, array),
                success: function (data) {
                    $.pjax.reload({container: \"#pjax-grid-view\"});  //Reload GridView
                    /**
                     * не обновляется виджет корзины
                     */
                    //$.pjax.reload({container:\"#cart-pjax\"});  //Обновить виджет корзины
                }
            });
            return false;
        });
    });
");

echo GridView::widget([
    'dataProvider' => $data->getDataProvider(),
    'pjax' => true,
    'bordered' => false,
    'striped' => false,
    'pjaxSettings' => [
        'options' => ['id' => 'pjax-grid-view']
    ],
    'options' => [
        'id' => 'grid-view',
    ],
    'columns' => [
        [
            'class' => '\kartik\grid\SerialColumn',
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'product.name',
            'value' => function ($data) {
                return $data->product->name;
            }
        ],
        'price:currency',
        [
            'contentOptions' => ['class' => 'action-column', 'data-method' => 'post'],
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'qty',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::textInput("Cart[{$data->product->id}]", $data->qty,
                    [
                        'data-product' => $data->product->id,
                        'class' => 'form-control',
                        'style' => 'width: 70px',
                    ]
                );
            },
            'pageSummary' => function ($summary, $data, $widget) {
                $result = [];
                foreach ($data as $input) {
                    preg_match("/value=\"[0-9]+\"/", $input, $preg);
                    preg_match("/[\d]+/", $preg[0], $number);
                    $result[] = $number[0];
                }
                return array_sum($result);
            },
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'label' => 'Сумма',
            'format' => 'currency',
            'value' => function ($data) {
                return $data->product->price * $data->qty;
            },
            'pageSummary' => true,
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            'template' => '{delete}',
        ],
    ],
    'showPageSummary' => true,
]);
?>
<div class="btn-group pull-right">
    <button id="refresh" class="btn btn-default"><?= Yii::t('shop', 'Button refresh cart'); ?></button>
    <a href="<?= Url::to(['/shop/order/index']) ?>" class="btn btn-primary"><?= Yii::t('shop', 'Button order'); ?></a>
</div>

