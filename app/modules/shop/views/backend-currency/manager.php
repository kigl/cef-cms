<?php
use app\modules\shop\Module;
use app\modules\backend\widgets\grid\GridView;

$text = Module::t('Currencies');

$this->setTitle($text);
$this->setPageHeader($text);
$this->params['breadcrumbs'] = $data['breadcrumbs'];

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
        'short_name',
        'name',
        'code',
        'exchange_rate',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{update} {delete}',
        ],
    ],
]);