<?php
use yii\helpers\Url;
use yii\helpers\Html;
use app\modules\infosystems\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Infosystems'));
$this->setPageHeader(Module::t( 'Infosystems'));
$this->params['breadcrumbs'][] = ['label' => Module::t( 'Infosystems')];

?>

<?= GridView::widget([
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
            'attribute' => 'code',
            'label' => Yii::t('app', 'Code'),
            'headerOptions' => ['style' => 'width: 10%'],
        ],
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(Html::encode($data->name), Url::to([
                    'backend-group/manager',
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