<?php 
use yii\helpers\Html;

// bootstrap
\app\modules\admin\views\assets\Asset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="<?= Yii::$app->charset;?>"/>
		<title><?= Html::encode($this->title);?></title>
		<?= Html::csrfMetaTags() ?>
		<?php $this->head();?>
	</head>
	<body class="bg-theme">
	<?php $this->beginBody();?>
		<div class="container-fluid wrapper">
			<div>
				<?= $content;?>
			</div>
		</div>
	<?php $this->endBody();?>
	</body>
</html>
<?php $this->endPage();?>