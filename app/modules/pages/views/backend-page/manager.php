<?php
use app\modules\pages\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Pages'));
$this->setPageHeader(Module::t('Pages'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Pages')];

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
        'name',
        'alias',
        'id',
        [
            'headerOptions' => ['style' => 'width: 50px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => '{update}  {delete}',
        ]
    ],
]); ?>