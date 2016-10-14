<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\informationsystem\models\InformationsystemItem as Item;
?>

<div class="col-md-4 margin-top-20">
	<?php if ($model->item_type === Item::TYPE_GROUP) {?>
	<a href="<?= Url::to(['news/manager', 'group_id' => $model->id])?>">
		<div class="informationsystem-group bg-content">
			<div class="row">
				<div class="col-md-1">
				<i class="fa fa-folder"></i>
				</div>
				<div class="col-md-11">
					Категория
				</div>
			</div>
			<h4 class="informationsystem-group__name"><?= Html::encode($model->name);?></h4>
		</div>
	</a>
	<?php } else {?>
	<a href="<?= Url::to(['news/view', 'id' => $model->id])?>">
		<div class="informationsystem-item bg-content">
			<div class="row">
				<div class="col-md-1">
					<i class="fa fa-newspaper-o"></i>
				</div>
				<div class="col-md-11">
					Элемент
				</div>
			</div>
			<h4 class="informationsystem-item__name"><?= Html::encode($model->name);?></h4>
			<div class="informationsystem-item-other">
				<ul class="list-inline small no-margin">
					<li><b><?= Yii::t('informationsystem', 'Create time');?>:</b> <?= Yii::$app->formatter->asDate($model->create_time);?></li>
					<li><b><?= Yii::t('informationsystem', 'User id');?>:</b> <?= $model->author->surname;?> <?= $model->author->name;?></li>
				</ul>
			</div>
		</div>
	</a>
	<?php }?>
</div>
