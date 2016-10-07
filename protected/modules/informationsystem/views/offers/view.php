<?php
use yii\helpers\Html;
use yii\helpers\Url;
?>


<div class="row">
	<div class="col-md-12">
		<div class="row">
			<div class="col-md-12">
				<div class="page-header">
				<h1><?= Html::encode($model->name);?></h1>
					<ul class="list-inline small">
						<li><b><?= Yii::t('informationsystem', 'Create time');?>: </b><?= Yii::$app->formatter->asDate($model->create_time);?></li>
					</ul>
				<div>
					<?php if (Yii::$app->user->can('updateOwnItem', ['model' => $model])) :?>
						<a href="<?= Url::to(['update', 'id' => $model->id])?>" class="btn btn-default btn-sm"><i class="glyphicon glyphicon-pencil"></i> <?= Yii::t('informationsystem', 'Button edit')?></a>
					<?php endif;?>
				</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<?= $model->content;?>
			</div>
		</div>
	</div>
</div>