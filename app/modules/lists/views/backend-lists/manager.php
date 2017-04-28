<?php
use yii\helpers\Html;
use app\modules\lists\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setPageHeader(Module::t('Lists'));

$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => ['create'],
            ],
        ],
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->name, ['backend-item/manager', 'list_id' => $model->id]);
            }
        ],
        'create_time:date',
        'id',
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
]);