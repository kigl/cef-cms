<?php
use yii\helpers\Html;
use app\modules\infosystems\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Tags'));
$this->setPageHeader(Module::t('Tags'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => ['create'],
            ],
        ],
        'delete' => [
            'item' => [
                'url' => ['backend-tag/selection-delete'],
            ],
        ],
    ],
    'columns' => [
        [
            'class' => \yii\grid\CheckboxColumn::className(),
        ],
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