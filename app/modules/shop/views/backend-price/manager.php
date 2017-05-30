<?php
use app\modules\backend\widgets\grid\GridView;
use app\modules\shop\Module;

$text = Module::t('Prices');

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

echo GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => ['create', 'shop_id' => $data['get']['shop_id']],
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