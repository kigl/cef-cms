<?php
use yii\helpers\Url;
use app\modules\admin\widgets\grid\GridView;
?>

<?= GridView::widget([
    'dataProvider' => $dataProviderGroup,
    'buttons' => [
        'create' => [
            'group' => [
                'url' => Url::to(['create', 'parent_id' => $parent_id]),
            ],
        ],
    ],
    'columns' => [
        'name',
        [
            'class' => \yii\grid\ActionColumn::className(),
        ],
    ],
]);?>
