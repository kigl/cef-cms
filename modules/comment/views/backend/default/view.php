<?php
use yii\widgets\DetailView;
?>

<?= DetailView::widget([
    'model' => $data['model'],
    'attributes' => [
        'id',
        'user.login',
        'create_time:dateTime',
        'content',
    ],
]);?>
