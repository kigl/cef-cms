<?php
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use app\modules\admin\widgets\grid\GridView;

$this->params['breadcrumbs'] = ArrayHelper::merge($breadcrumbs, [
    ['label' => Yii::t($this->context->module->id, 'Tags')]
]);

?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to([
                    'create/tag',
                    'informationsystem_id' => $informationsystem_id,
                ]),
            ],
        ],
    ],
    'dataProvider' => $dataProvider,
    'filterModel' => $searchModel,
    'columns' => [
        'name',
        'id',
        [
            'headerOptions' => ['style' => 'width: 50px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', [
                            'update/tag',
                            'id' => $model->id
                        ]
                    );
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', [
                        'delete/tag',
                        'id' => $model->id
                    ],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]
                    );
                }
            ],
        ]
    ],
]); ?>