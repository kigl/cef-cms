<?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Html;

?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'id',
        'create_time:datetime',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{view} {delete}",
            'buttons' => [
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
