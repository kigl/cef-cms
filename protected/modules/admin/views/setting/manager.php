<?php
use app\modules\admin\widgets\grid\GridView;

?>

<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'buttons' => ['create' => ['item']],
        'columns' => [
            'module_id',
            'name',
            'label',
            'value',
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
