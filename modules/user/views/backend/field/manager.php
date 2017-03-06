<?php
use yii\helpers\Url;
use app\modules\backend\widgets\grid\GridView;

$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Additional properties')];
$this->setPageHeader(Yii::t('app', 'Manager: {data}', ['data' => 'дополнительных свойств']));
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
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update} {delete}",
        ]
    ],
]);?>
