<?php
use yii\helpers\Html;
use app\modules\backend\widgets\grid\GridView;

$this->setPageHeader(Yii::t('app', 'Manager: {data}', ['data' => 'пользователей']));
?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'buttons' => ['create' => ['item']],
    'columns' => [
        'login',
        [
            'attribute' => 'status',
            'value' =>
                function ($data) {
                    return $data->getStatus($data->status);
                },
        ],
        'email',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{view}  {update}  {delete}',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', [
                            'view',
                            'id' => $model->id
                        ],
                    ['class' => 'show-in-modal']
                    );
                },
            ],
        ]
    ],
]);
?>
