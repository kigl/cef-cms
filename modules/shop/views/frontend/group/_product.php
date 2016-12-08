<?= \yii\widgets\DetailView::widget([
    'model' => $model,
    'attributes' => [
        [
            'label' => 'id',
            'value' => $model->id,
        ],
        [
            'format' => 'raw',
            'label' => 'name',
            'value' => \yii\helpers\Html::a($model->name, ['/shop/product/view', 'id' => $model->id]),
        ],
        'description',
        'price',
    ],
]);
