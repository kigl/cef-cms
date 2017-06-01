<?php
use app\modules\shop\Module;
use app\modules\backend\widgets\grid\GridView;

$message = Module::t('Measures');

$this->setTitle($message);
$this->setPageHeader($message);
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
        'name',
        'short_name',
        'code',
        'id',
        [
            'class' => \yii\grid\ActionColumn::className(),
            'template' => '{update} {delete}',
        ],
    ],
]);