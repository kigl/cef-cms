<?php
use yii\widgets\DetailView;
?>

<?= DetailView::widget([
    'model' => $data->getModel(),
    'attributes' => ['id', 'login', 'surname', 'name', 'lastname', 'email', 'create_time'],
]);?>
