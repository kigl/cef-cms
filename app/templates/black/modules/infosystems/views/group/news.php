<?php
use yii\widgets\ListView;

?>

<div class="container content">
    <div class="row">
        <div class="col-md-12">
            <?= ListView::widget([
                'itemView' => '_newsItem',
                'dataProvider' => $data['dataProvider'],
                'layout' => /*"{summary}\n{sorter}\n*/"<div class='row'>{items}</div>\n<div class='text-center'>{pager}</div>",
                'sorter' => [
                    'options' => ['class' => 'list-inline panel'],
                ],
            ]); ?>
        </div>
    </div>
</div>
