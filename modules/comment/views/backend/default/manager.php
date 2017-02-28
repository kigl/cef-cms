<?php
use app\modules\backend\widgets\grid\GridView;
use yii\helpers\Url;
?>

<?= GridView::widget([
    'dataProvider' => $data['dataProvider'],
    'columns' => [
        'id',
        'model_class',
        'user_id',
        'content',
        'create_time:dateTime',
    ],
]);?>
