<?php
use app\modules\admin\widgets\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $data->getDataProvider(),
    'columns' => [
        'id',
        [
            'attribute' => 'login',
            'value' => function ($data) {
                return $data->user->name;
            }
        ],
        'create_time:dateTime',
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ],
])?>
