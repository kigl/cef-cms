<?php
use app\modules\admin\widgets\grid\GridView;

?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'buttons' => ['create' => ['element']],
        'columns' => [
            'module_id',
            'name',
            'label',
            'views',
            'id',
            [
                'headerOptions' => ['style' => 'width: 50px'],
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update}  {delete}',
            ],
        ],
    ]
);
?>
