<?php
$this->registerJsFile('@web/modules/shop/views/frontend/js/addToCart.js', ['position' => \yii\web\View::POS_BEGIN]);

\yii\widgets\Pjax::begin();
echo \yii\widgets\ListView::widget([
    'dataProvider' => $data->getDataProvider(),
    'itemView' => '_product',
    'summaryOptions' => [
        'class' => 'text-right',
    ],
    'layout' => "{summary}\n{sorter}\n<div class='row'>{items}</div>\n<div class='text-center'>{pager}</div>",
    'itemOptions' => ['class' => 'col-md-4'],
    'summaryOptions' => ['class' => 'text-right'],
    'sorter' => [
        'options' => ['class' => 'list-inline'],
    ],
]);
\yii\widgets\Pjax::end();
?>