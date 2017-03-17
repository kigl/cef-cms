<?php if ($model) : ?>
    <img src="<?= $model->getFileUrl(); ?>" style="width: 100%;"/>
<?php else : ?>
    <div class="text-center bold">@todo not image</div>
<?php endif; ?>
