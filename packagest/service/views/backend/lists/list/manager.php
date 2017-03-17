<?php
use kigl\cef\module\backend\widgets\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create']),
            ],
        ],
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->name, ['lists/item/manager', 'list_id' => $model->id]);
            }
        ],
        'id',
        'create_time',
    ],
]);