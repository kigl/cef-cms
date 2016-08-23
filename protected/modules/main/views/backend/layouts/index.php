<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use app\modules\main\widgets\adminPanel\AdminPanel;
use yii\widgets\Breadcrumbs;
// bootstrap
\app\modules\main\Asset::register($this);
?>
<?php $this->beginPage()?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="<?= Yii::$app->charset;?>"/>
		<title><?php echo $this->getPageTitle();?></title>
		<?= Html::csrfMetaTags() ?>
		<?php $this->head();?>
	</head>
	<body>
	<?php $this->beginBody();?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php echo AdminPanel::widget();?>
					<div class="row">
						<div class="col-md-12">
							<?php echo Breadcrumbs::widget([
								'links' => isset($this->breadcrumbs)? $this->breadcrumbs : [],
							]);?>
							<?php if (isset($this->pageHeader)) :?>
								<div class="page-header">
									<h3><?php echo $this->pageHeader;?></h3>
								</div> 	
							<?php endif;?>
							<?php 
								if (isset($this->toolbar)) {
									echo Menu::widget([
										'options' => ['class' => 'list-inline'],
										'encodeLabels' => false,
										'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
										'items' => $this->toolbar,
									]);
								}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<?= $content;?>
				</div>
			</div>
		</div>
	<?php $this->endBody();?>
	</body>
</html>
<?php $this->endPage();?>