<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\admin\widgets\grid\GridView;
use app\modules\shop\models\Group;
use app\core\helpers\Breadcrumbs;

$this->setBreadcrumbs(Breadcrumbs::getLinksGroup(
    $parent_id,
    [
        'modelClass' => Group::className(),
        'urlOptions' => [
            'route' => '/admin/shop/group/manager',
            'queryGroupName' => 'parent_id',
        ],
    ]
)
);

$this->params['toolbar'] = [
    ['label' => '<i class="fa fa-cogs"></i> ' . Yii::t('shop', 'Toolbar property'), 'url' => ['property/manager']],
];
?>

<?= GridView::widget([
    'dataProviderGroup' => $dataProviderGroup,
    'dataProvider' => $dataProviderProduct,
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to(['create', 'parent_id' => $parent_id]),
            ],
            'item' => [
                'url' => Url::to(['product/create', 'group_id' => $parent_id]),
            ],
        ],
    ],
    'columnsGroup' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a($data->name, ['manager', 'parent_id' => $data->id]);
            }
        ],
        [],
        'create_time:date',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
        ],
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'headerOptions' => ['style' => 'width: 50%'],
        ],
        'price',
        'create_time:date',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'product/update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'product/delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                    );
                }
            ],
        ],
    ],
]);?>
