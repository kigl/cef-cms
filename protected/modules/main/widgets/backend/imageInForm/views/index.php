<?php 
use yii\helpers\Html;
?>

<?php if ($model->fileExist()) :?>
<div class="img-thumbnail">
	<div class="pull-right">Удалить <input type="checkbox" name="deleteFile"></div>
	<div><?= Html::a($model->image, $model->getFileUrl(), ['target' => '_blank']);?></div>
</div>
<?php endif;?>