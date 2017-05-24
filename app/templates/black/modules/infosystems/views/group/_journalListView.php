<?php
use yii\widgets\ListView;

echo ListView::widget([
    'itemView' => '_journal',
    'options' => ['class' => 'journal-article-list'],
    'itemOptions' => function ($model, $key, $index, $widget) {
        if ($index % 2 == 0) {
            return ['class' => 'left journal-article', 'tag' => 'article'];
        } else {
            return ['class' => 'right journal-article', 'tag' => 'article'];
        }
    },
    'summaryOptions' => ['class' => 'margin-bottom-10 text-right'],
    'dataProvider' => $data['dataProvider'],
    'layout' => "{summary}\n{items}\n<div class='text-center'>{pager}</div>",
    'sorter' => ['options' => ['class' => 'list-inline panel'],],
]); ?>