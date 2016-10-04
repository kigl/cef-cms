<?php if ($model->fileExist()) :?>
<div class="img-thumbnail">
	<div class="pull-right">Удалить <input type="checkbox" name="deleteFile"></div>
	<div><?= $model->image?></div>
</div>
<?php endif;?>
<?= $form->field($model, $attribute)->fileInput();?>