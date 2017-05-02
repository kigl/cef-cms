<?php
use app\modules\backend\widgets\grid\GridView;
use app\modules\lists\Module;
use yii\helpers\Url;
use yii\helpers\Html;

$this->setPageHeader(Module::t('Items'));

$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => ['create', 'list_id' => $data['listId']],
            ],
        ],
        'delete' => [
            'item' => [
                'url' => 'create',
                'linkOptions' => ['class' => 'selected-delete'],
            ],
        ],
    ],
    'columns' => [
        [
            'class' => \yii\grid\CheckboxColumn::className(),
        ],
        'value',
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
?>