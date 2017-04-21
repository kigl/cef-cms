<?php
use app\modules\menu\Module;
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;

$this->setTitle(Module::t('Menu'));
$this->setPageHeader(Module::t('Menu'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Menu')];
?>

<?= GridView::widget([
    'dataProvider' => $dataProvider,
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
            'value' => function ($data) {
                return Html::a($data->name, ['backend-item/manager', 'menu_id' => $data->id]);
            }
        ],
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
    ]
])?>
