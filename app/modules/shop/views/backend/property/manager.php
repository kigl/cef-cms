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
    ],
]); ?>
