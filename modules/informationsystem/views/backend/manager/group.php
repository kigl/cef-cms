<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\backend\widgets\grid\GridView;

?>

<?php echo GridView::widget([
    'filterModel' => $data->getSearchModel(),
    'dataProvider' => $data->getDataProvider(),
    'dataProviderGroup' => $data->getGroupDataProvider(),
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to([
                    'create/group',
                    'informationsystem_id' => $data->getData('informationSystemId'),
                    'parent_id' => $data->getData('id'),
                ]),
            ],
            'item' => [
                'url' => Url::to([
                    'create/item',
                    'informationsystem_id' => $data->getData('informationSystemId'),
                    'group_id' => $data->getData('id'),
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
                    ['group', 'id' => $data->id, 'informationsystem_id' => $data->informationsystem_id]);
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
        'id',
        'name',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
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
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ]
    ],
]); ?>
