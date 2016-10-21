<?php
use yii\helpers\Html;

$this->params['breadcrumbs'] = $breadcrumbs;
?>


<div class="bg-content">
	<div class="row">
		<div class="col-md-12">
			<div class="row">
				<div class="col-md-12">
					<div class="page-header">
					<h1><?= Html::encode($model->name);?></h1>
						<ul class="list-inline">
							<li><b><?= Yii::t('informationsystem', 'Create time');?>: </b><?= Yii::$app->formatter->asDate($model->create_time);?></li>
							<li><span><b><?= Yii::t('informationsystem', 'User id');?>: </b><?= $model->author->surname;?> <?= $model->author->name;?></span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<video id="movie" width="100%" preload controls>
						<source src="<?= $model->getBehavior('fileUpload')->getFileUrl();?>" /> 
					</video>
				</div>
			</div>
		</div>
	</div>
</div>