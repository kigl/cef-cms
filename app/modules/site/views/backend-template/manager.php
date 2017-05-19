<?php
use app\modules\site\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Templates'));
$this->setPageHeader(Module::t('Templates'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Templates'), 'url' => 'manager'];

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
        'id',
        'name',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
        ]
    ],
]);