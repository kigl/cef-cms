<?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'element' => [
                'url' => Url::to(['create', 'form_id' => $formId]),
            ],
        ],
    ],
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        [
            'attribute' => 'sorting',
            'format' => 'raw',
            'value' => function ($data) {
                return \kartik\editable\Editable::widget([
                    'name' => 'Field[sorting]',
                    'value' => $data->sorting,
                    'formOptions' => ['action' => ['edit-sorting', 'id' => $data->id]],
                ]);
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
