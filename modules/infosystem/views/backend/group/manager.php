<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\backend\widgets\grid\GridView;
use app\core\helpers\Breadcrumbs;

$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<?=GridView::widget([
    //'filterModel' => $data['searchModel'],
    'dataProvider' => $data['dataProvider'],
    'dataProviderGroup' => $data['groupDataProvider'],
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to([
                    'create',
                    'infosystem_id' => $data['infosystem']->id,
                    'parent_id' => $data['id'],
                ]),
            ],
            'item' => [
                'url' => Url::to([
                    'item/create',
                    'infosystem_id' => $data['infosystem']->id,
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
        'id',
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
        'name',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'item/update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'item/delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ]
    ],
]); ?>
