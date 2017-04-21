<?php
use yii\widgets\ListView;

?>



<?= ListView::widget([
    'itemView' => '_item',
    'dataProvider' => $data['dataProvider'],
    'layout' => "{summary}\n{sorter}\n<div class='row'>{items}</div>\n<div class='text-center'>{pager}</div>",
    'sorter' => [
        'options' => ['class' => 'list-inline panel'],
    ],
]);?>
