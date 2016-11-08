<?php 
use yii\helpers\Html;

\app\modules\admin\views\assets\Asset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html class="height-all">
	<head>
		<meta charset="<?= Yii::$app->charset;?>"/>
		<title><?= Html::encode($this->title);?></title>
		<?= Html::csrfMetaTags() ?>
		<?php $this->head();?>
	</head>
	<body class="height-all">
	<?php $this->beginBody();?>
		<div class="container-fluid wrapper height-all">
			<div class="height-all">
				<?= $content;?>
			</div>
		</div>
	<?php $this->endBody();?>
	</body>
</html>
<?php $this->endPage();?>