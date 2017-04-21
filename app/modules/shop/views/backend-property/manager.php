<?php
use yii\helpers\Url;
use app\modules\shop\Module;
use app\modules\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Product properties'));
$this->setPageHeader(Module::t('Product properties'));
$this->params['breadcrumbs'] = [
    ['label' => Module::t('Products'), 'url' => ['backend-group/manager']],
    ['label' => Module::t('Product properties')],
];
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
    'options' => [
        'data' => [
            'sortable-widget' => 1,
            'sortable-url' => \yii\helpers\Url::to(['backend-property/sorting']),
        ]
    ],
    'columns' => [
        'name',
        'description',
        [
            'attribute' => 'type',
            'value' => function ($model) {
                return $model->getType($model->type);
            }
        ],
        [
            'attribute' => 'required',
            'value' => function ($model) {
                return $model->required ? Yii::t('app', 'Yes') : Yii::t('app', 'No');
            }
        ],
        [
            'class' => \kotchuprik\sortable\grid\Column::className(),
        ],
        'sorting',
        'id',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
        ],
    ],
]); ?>
