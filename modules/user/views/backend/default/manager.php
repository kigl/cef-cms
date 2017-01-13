<?php
use app\modules\admin\widgets\grid\GridView;
use app\modules\user\helpers\StatusHelper;
use yii\widgets\Menu;

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
                    return StatusHelper::get($data->status);
                },
        ],
        'email',
        [
            'headerOptions' => ['style' => 'width: 50px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
        ]
    ],
]);
?>
