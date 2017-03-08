<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Yii::t('infosystem', 'Infosystem'));
$this->setPageHeader(Yii::t('infosystem', 'Infosystem'));
$this->params['breadcrumbs'][] = ['label' => Yii::t('infosystem', 'Infosystem')];

?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create']),
            ],
        ],
    ],
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Html::encode($data->name), Url::to([
                    'group/manager',
                    'infosystem_id' => $data->id,
                ]));
            }
        ],
        'create_time:date',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
            'buttons' => [
                'update' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-pencil"></i>', ['update', 'id' => $model->id]);
                },
                'delete' => function ($url, $model, $key) {
                    return Html::a('<i class="glyphicon glyphicon-trash"></i>', ['delete', 'id' => $model->id],
                        ['date-method' => 'POST', 'data-confirm' => Yii::t('app', 'question on delete file')]);
                }
            ],
        ]
    ],
]); ?>