<?php
use yii\grid\GridView;
use yii\helpers\Html;

echo GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'id',
        'parent_id',
        'infosystem.name',
        'name',
        'date:date',
    ],
]);