<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 17.12.2016
 * Time: 21:13
 */

\yii\widgets\Pjax::begin();
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data->getDataProvider(),
    'itemView' => '/group/_product',
    'summaryOptions' => [
        'class' => 'text-right',
    ],
    'layout' => "{summary}\n{sorter}\n<div class='row'>{items}</div>\n<div class='text-center'>{pager}</div>",
    'itemOptions' => ['class' => 'product-item col-md-4'],
    'summaryOptions' => ['class' => 'text-right'],
    'sorter' => [
        'options' => ['class' => 'list-inline'],
    ],
]);
\yii\widgets\Pjax::end();