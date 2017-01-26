<?php
use yii\helpers\Html;
use app\modules\admin\widgets\grid\GridView;
use app\modules\user\helpers\StatusHelper;

$this->params['toolbar'] = [
    [
        'label' => '<i class="fa fa-minus"></i> ' . Yii::t('user', 'Toolbar field'),
        'url' => ['field/manager'],
    ],
    ['label' => Yii::t('user', 'Toolbar rbac'), 'url' => ['rbac/manager']],
];
?>

<?php
echo GridView::widget([
    'dataProvider' => $dataProvider,
    'buttons' => ['create' => ['item']],
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
