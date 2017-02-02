<?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Url;
use yii\helpers\Html;
?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'buttons' => [
        'create' => [
            'item' => [
                'url' => Url::to([
                    'create-item',
                    'menu_id' => $data['menuId'],
                    'parent_id' => $data['parentId'],
                ]),
            ],
        ]
    ],

    'columns' => [
        'id',
        [
            'attribute' => 'name',
            'format' => 'raw',
            'value' => function ($data) {
                return Html::a(
                    $data->name,
                    ['manager-item', 'menu_id' => $data->menu_id, 'parent_id' => $data>id]
                );
            }
        ]
    ],
]);?>
