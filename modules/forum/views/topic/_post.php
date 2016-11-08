<?php
use yii\helpers\Html;
?>

<div class="bg-content">
	<div class="row">
		<div class="col-md-9">
			<div><?= $model->topic->name;?></div>
			<div>
				<ul class="list-inline small">
					<li><i class="fa fa-user"></i> <?= $model->author->surname;?> <?= $model->author->name;?></li>
					<li><?= Yii::$app->formatter->asDatetime($model->create_time)?></li>
				</ul>
			</div>
			<div>
				<?= $model->content;?>
			</div>
		</div>
		<div class="col-md-3">
		<div class="row">
			<div class="col-md-12">
				<ul class="list-unstyled small">
					<li><?= $model->author->surname;?> <?= $model->author->name;?></li>
					<li><?= Yii::t('user', 'Rank id')?>: <?= $model->author->rank->name;?></li>
					<li><?= Yii::t('user', 'Register date');?>: <?= Yii::$app->formatter->asDate($model->author->create_time);?></li>
				</ul>
			</div>
			<div class="col-md-12">			
				<?php if ($model->author->thumbnailExist()) echo Html::img($model->author->getThumbnailUrl(), ['class' => 'img-thumbnail']);?>
			</div>
		</div>
		</div>
	</div>
</div>