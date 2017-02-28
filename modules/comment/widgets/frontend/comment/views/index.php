<?php foreach ($data['items'] as $item) : ?>
    <div class="row">
        <div class="col-md-12">
            <ul>
                <li><?= $item->id;?></li>
                <li><?= $item->parent_id;?></li>
                <li><?= $item->user->name ?></li>
                <li><?= Yii::$app->formatter->asDatetime($item->create_time); ?></li>
                <li><?= $item->content; ?></li>
                <a data-toggle="collapse" data-target="#parent-comment-<?= $item->id ?>">
                    Ответить
                </a>
                    <div class="collapse" id="parent-comment-<?= $item->id ?>">
                        <?= $this->render('_form', ['data' => array_merge($data, ['model' => $item])]); ?>
                    </div>
            </ul>
        </div>
    </div>
<?php endforeach; ?>

<?php
if (!Yii::$app->user->isGuest) {
    echo $this->render('_form', ['data' => $data]);
}
?>