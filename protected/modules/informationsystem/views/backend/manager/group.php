<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\admin\widgets\grid\GridView;

$this->params['breadcrumbs'] = $breadcrumbs;

$this->params['toolbar'] = [
    [
        'label' => '<i class="glyphicon glyphicon-tags"></i> ' . Yii::t('informationsystem', 'Tag toolbar'),
        'url' => ['manager/tag', 'informationsystem_id' => $informationsystem_id],
    ]
];
?>

<?php echo GridView::widget([
    'filterModel' => $searchModel,
    'dataProvider' => $dataProvider,
    'dataProviderGroup' => $dataProviderGroup,
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to([
                    'create/group',
                    'informationsystem_id' => $informationsystem_id,
                    'parent_id' => $parent_id,
                ]),
            ],
            'item' => [
                'url' => Url::to([
                    'create/item',
                    'informationsystem_id' => $informationsystem_id,
                    'group_id' => $parent_id,
                ]),
            ],
        ],
    ],
    'columnsGroup' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a($data->name,
                    ['group', 'parent_id' => $data->id, 'informationsystem_id' => $data->informationsystem_id]);
            }
        ],
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'update/group',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'delete/group',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                    );
                }
            ],
        ]
    ],

    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return $data->name . "&nbsp;&nbsp;&nbsp;<span class='small'>(" . Yii::$app->formatter->asDate($data->create_time) . ")</span>";
            },
        ],
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'buttons' => [
                'view' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-eye-open"></i>', ['view', 'id' => $model->id],
                        ['class' => 'view-item']);
                },
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'update/item',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'delete/item',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                    );
                }
            ],
        ]
    ],
]); ?>