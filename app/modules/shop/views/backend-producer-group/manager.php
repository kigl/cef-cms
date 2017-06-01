<?php
use yii\helpers\Html;
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
                    'parent_id' => isset($data['id']) ? $data['id'] : null
                ]
            ],
            'item' => [
                'url' => [
                    'backend-producer/create',
                    'shop_id' => $data['shop_id'],
                    'group_id' => isset($data['id']) ? $data['id'] : null
                ],
            ],
        ],
    ],
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($model) use ($data) {
                return array_key_exists('group_id', $model) ?
                    $model['name'] :
                    Html::a($model['name'], ['manager', 'shop_id' => $data['shop_id'], 'id' => $model['id']]);
            }
        ],
        'id',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{update} {delete}',
        ],
    ],
]);