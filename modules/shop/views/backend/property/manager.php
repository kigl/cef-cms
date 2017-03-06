<?php
use yii\helpers\Url;
use app\modules\backend\widgets\grid\GridView;

$this->setPageHeader(Yii::t('app', 'Manager: {data}', ['data' => 'дополнительных свойств']));
$this->params['breadcrumbs'][] = ['label' => 'дополнительные свойства'];
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
