<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\backend\widgets\grid\GridView;
use app\modules\shop\Module;

$text = Module::t('Producers');

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo GridView::widget([
    'buttons' => [
        'create' => [
            'group' => [
                'url' => [
                    'create',
                    'shop_id' => $data['shop_id'],
                    'parent_id' => $data['id']
                ]
            ],
            'item' => [
                'url' => [
                    'backend-producer/create',
                    'shop_id' => $data['shop_id'],
                    'group_id' => $data['id']
                ],
            ],
        ],
    ],
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        [
            'attribute' => 'name',
            'label' => Yii::t('app', 'Name'),
            'format' => 'raw',
            'value' => function ($model) use ($data) {
                return array_key_exists('group_id', $model) ?
                    $model['name'] :
                    Html::a($model['name'], ['manager', 'shop_id' => $data['shop_id'], 'id' => $model['id']]);
            }
        ],
        [
            'attribute' => 'sorting',
            'label' => Yii::t('app', 'Sorting'),
        ],
        [
            'attribute' => 'id',
            'label' => Yii::t('app', 'ID'),
        ],
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{update} {delete}',
            'urlCreator' => function ($action, $model, $key, $index) {
                return  array_key_exists('group_id', $model) ?
                    Url::to(["backend-producer/" . $action, 'id' => $model['id']]) :
                    Url::to([$action, 'id' => $model['id']]);
            }
        ],
    ],
]);