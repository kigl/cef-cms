<?php
use yii\helpers\Url;
use app\modules\backend\widgets\grid\GridView;
?>

<?= GridView::widget([
    'buttons' => [
        'create' => [
            'element' => [
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
