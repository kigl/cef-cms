<?php
use yii\widgets\DetailView;
?>

<?= DetailView::widget([
    'model' => $data['model'],
    'attributes' => ['id', 'login', 'surname', 'name', 'lastname', 'email', 'create_time'],
]);?>
