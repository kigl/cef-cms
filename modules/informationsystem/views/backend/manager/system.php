<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\backend\widgets\grid\GridView;

?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create/system']),
            ],
        ],
    ],
    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Html::encode($data->name), Url::to([
                    'manager/group',
                    'informationsystem_id' => $data->id,
                ]));
            }
        ],
        'create_time:date',
        [
            'headerOptions' => ['style' => 'width: 50px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update/system', 'id' => $model->id]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete/system', 'id' => $model->id],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]);
                }
            ],
        ]
    ],
]); ?>