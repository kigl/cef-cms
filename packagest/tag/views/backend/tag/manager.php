<?php
use yii\helpers\Url;
use yii\helpers\Html;
use kigl\cef\module\tag\Module;
use kigl\cef\module\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Tags'));
$this->setPageHeader(Module::t('Tags'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Tags')];
?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to([
                    'create',
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
]); ?>