<?php
use yii\helpers\Url;
use app\modules\shop\Module;
use app\modules\backend\widgets\grid\GridView;

$text = Module::t('Product properties');

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];
?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create', 'shop_id' => $data['shop_id']]),
            ],
        ],
    ],
    'rowOptions' => function ($model, $key, $index, $grid) {
        return ['data-sortable-id' => $model->id];
    },
    'dataProvider' => $data['dataProvider'],
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
