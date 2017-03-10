<?php
use yii\helpers\Url;
use app\modules\user\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('User properties'));
$this->setPageHeader(Module::t('User properties'));
$this->params['breadcrumbs'][] = ['label' => Module::t('User properties')];
?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create']),
            ],
        ],
    ],
    'rowOptions' => function ($model, $key, $index, $grid) {
        return ['data-sortable-id' => $model->id];
    },
    'dataProvider' => $dataProvider,
    'columns' => [
        'name',
        [
            'class' => \kotchuprik\sortable\grid\Column::className(),
        ],
        'sorting',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update} {delete}",
        ]
    ],
    'options' => [
        'data' => [
            'sortable-widget' => 1,
            'sortable-url' => \yii\helpers\Url::to(['property/sorting']),
        ]
    ],
]); ?>
