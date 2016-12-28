<?php
use kartik\grid\GridView;
use yii\helpers\Html;
?>

<?php
/*
echo GridView::widget([
    'dataProvider' => $data->getDataProvider(),
    'columns' => [
        'id',
        'product.name',
        'qty',
        'product.price',
    ],
]);
 */
?>

<?= GridView::widget([
    'dataProvider' => $data->getDataProvider(),
    'hover' => true,
    'columns' => [
        'id',
        'product.name',
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'qty',
            'format' => 'raw',
            'value' => function ($data) {
                return $data->qty;
            },
            'pageSummary' => true,
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'product.price',
            'format' => 'currency',
            'pageSummary' => true
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'qty',
            'editableOptions'=>[
                'header'=>'Buy Amount',
                'inputType'=>\kartik\editable\Editable::INPUT_SPIN,
                'options'=>['pluginOptions'=>['min'=>0, 'max'=>5000]],
                'formOptions' => ['action' => ['/shop/cart/edit']],
            ],
            'pageSummary'=>true
        ],
    ],
    'showPageSummary' => true,
]); ?>
