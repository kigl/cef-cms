<?php
use yii\helpers\Html;
use app\modules\backend\widgets\grid\GridView;
use app\modules\sites\Module;

$this->setTitle(Module::t('Sites'));
$this->setPageHeader(Module::t('Sites'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Sites'), 'url' => 'manager'];

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
        'domain',
        [
            'attribute' => 'active',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::checkbox('Active', $data->active, ['disabled' => 'disabled']);
            }
        ],
        'name',
        'template_id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ]
    ],
]);