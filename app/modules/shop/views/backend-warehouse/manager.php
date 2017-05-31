<?php
use app\modules\backend\widgets\grid\GridView;
use app\modules\shop\Module;

$text = Module::t('Warehouses');

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => ['create', 'shop_id' => $data['shop_id']],
            ],
        ],
    ],
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'name',
        'id',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{update} {delete}',
        ],
    ],
]);