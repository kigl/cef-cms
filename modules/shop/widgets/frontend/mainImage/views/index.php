<?php
/**
 * Created by PhpStorm.
 * User: kirill
 * Date: 16.12.2016
 * Time: 21:08
 */
?>
<?php if ($model) : ?>
    <img src="<?= $model->getFileUrl(); ?>" style="width: 100%;"/>
<?php else : ?>
    <div class="text-center bold">@todo not image</div>
<?php endif; ?>
