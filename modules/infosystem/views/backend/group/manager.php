<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\backend\widgets\grid\GridView;
use app\core\helpers\Breadcrumbs;

?>

<?php echo GridView::widget([
    'filterModel' => $data['searchModel'],
    'dataProvider' => $data['dataProvider'],
    'dataProviderGroup' => $data['groupDataProvider'],
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to([
                    'create',
                    'infosystem_id' => $data['infosystemId'],
                    'parent_id' => $data['id'],
                ]),
            ],
            'element' => [
                'url' => Url::to([
                    'element/create',
                    'infosystem_id' => $data['infosystemId'],
                    'group_id' => $data['id'],
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
                    ['manager', 'id' => $data->id, 'infosystem_id' => $data->infosystem_id]);
            }
        ],
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'delete',
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
                            'element/update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'element/delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ]
    ],
]); ?>
