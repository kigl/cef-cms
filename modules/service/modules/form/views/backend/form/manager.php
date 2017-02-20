<?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'element' => [
                'url' => Url::to(['create']),
            ],
        ],
    ],
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Html::encode($data->name), ['completed/manager', 'form_id' => $data->id]);
            }
        ],
        [
            'label' => null,
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Yii::t('app', 'Fields'), ['field/manager', 'form_id' => $data->id]);
            }
        ],
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
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
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'Question on delete file')]
                    );
                }
            ],
        ],
    ],
]); ?>
