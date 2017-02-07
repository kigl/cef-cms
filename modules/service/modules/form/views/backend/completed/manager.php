<?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Html;

?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'id',
        'create_time',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{view} {delete}",
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'view',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'delete',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ],
    ],
]); ?>
