<?php
use yii\widgets\DetailView;
use kartik\grid\GridView;
?>

<?= DetailView::widget([
    'model' => $data->getModel(),

]);?>

<?= GridView::widget([
    'dataProvider' => $data->getDataProvider(),
    'showPageSummary' => true,
    'columns' => [
        'id',
        'name',
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'qty',
            'pageSummary' => true,
        ],
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'price',
            'format' => 'currency',
            'pageSummary' => true,
        ],
    ],
]);?>
