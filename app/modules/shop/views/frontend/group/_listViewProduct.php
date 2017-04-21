<?php


\yii\widgets\Pjax::begin();
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data['dataProvider'],
    'itemView' => '_product',
    'summaryOptions' => [
        'class' => 'text-right',
    ],
    'layout' => "{summary}\n{sorter}\n<div class='row'>{items}</div>\n<div class='text-center'>{pager}</div>",
    'itemOptions' => ['class' => 'col-md-4'],
    'summaryOptions' => ['class' => 'text-right'],
    'sorter' => [
        'options' => ['class' => 'list-inline panel'],
    ],
]);
\yii\widgets\Pjax::end();
?>