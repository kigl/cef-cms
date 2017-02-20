<?php
use yii\helpers\Html;
use app\modules\backend\widgets\grid\GridView;
use app\modules\user\helpers\StatusHelper;

?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'buttons' => ['create' => ['element']],
    'columns' => [
        'id',
        'login',
        [
            'attribute' => 'status',
            'value' =>
                function ($data) {
                    return $data->getStatus($data->status);
                },
        ],
        'email',
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
