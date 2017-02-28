<?php foreach ($data['items'] as $model) : ?>
    <?php if ($model->parent_id == $parentId) : ?>
        <ul class="groove">
            <li><input type="text" value="<?= $model->id?>"/></li>
            <li><?= $model->content; ?></li>
            <li>

                <a href="#comment" class="test">
                    Ответить
                </a>
            </li>
        </ul>
        <ul>
            <li>
                <?= $this->render('_item', [
                    'data' => $data,
                    'parentId' => $model->id,
                ]) ?>
            </li>
        </ul>
    <?php endif; ?>
<?php endforeach; ?>
