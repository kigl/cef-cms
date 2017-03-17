<?php
use yii\helpers\Url;
use kigl\cef\module\shop\Module;
use kigl\cef\module\backend\widgets\grid\GridView;

$this->setTitle(Module::t('Product properties'));
$this->setPageHeader(Module::t('Product properties'));
$this->params['breadcrumbs'][] = ['label' => Module::t('Product properties')];
?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to(['create']),
            ],
        ],
    ],
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'name',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => \yii\grid\ActionColumn::className(),
            'template' => "{update} {delete}",
        ],
    ],
]); ?>
