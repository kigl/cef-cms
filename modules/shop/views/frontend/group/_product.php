<?php
echo \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'image',
            'format' => 'raw',
            'value' => \yii\helpers\Html::img($model->getMainImage(), ['style' => 'max-width: 200px']),
        ],
        [
            'label' => 'id',
            'value' => $model->id,
        ],
        [
            'format' => 'raw',
            'label' => 'name',
            'value' => \yii\helpers\Html::a($model->name, $model->getUrl()),
        ],
        'description',
        'price',
    ],
]);
