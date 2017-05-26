<?php
use yii\helpers\Html;
use app\modules\shop\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Shops'));
$this->setPageHeader(Module::t('Shops'));
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => ['create'],
            ],
        ],
    ],
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'code',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($model) {
                return Html::a($model->name, ['backend-group/manager', 'shop_id' => $model->id]);
            }
        ],
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ]
    ],
]);