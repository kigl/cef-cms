<?php
use yii\helpers\Url;
use app\modules\admin\widgets\grid\GridView;
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
        'name',
        [
            'headerOptions' => ['style' => 'width: 70px'],
            'class' => 'yii\grid\ActionColumn',
            'template' => "{update} {delete}",
        ]
    ],
]);?>
