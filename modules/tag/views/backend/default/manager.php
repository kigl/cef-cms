<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\backend\widgets\grid\GridView;

?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to([
                    'default/create',
                ]),
            ],
        ],
    ],
    'dataProvider' => $data['dataProvider'],
    //'filterModel' => $data['searchModel'],
    'columns' => [
        'id',
        'name',
        [
            'headerOptions' => ['style' => 'width: 50px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'default/update',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'default/delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                    );
                }
            ],
        ]
    ],
]); ?>