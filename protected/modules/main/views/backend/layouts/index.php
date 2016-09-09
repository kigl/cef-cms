<?php 
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Menu;
use app\modules\main\widgets\Breadcrumbs;
use app\modules\main\widgets\Alert;
use app\modules\main\widgets\adminPanel\AdminPanel;
// bootstrap
\app\modules\main\assets\Asset::register($this);
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
	<body>
	<?php $this->beginBody();?>
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<?php echo AdminPanel::widget();?>
					<div class="row">
						<div class="col-md-12">
							<?php  echo Breadcrumbs::widget([
								'homeLink' => [
									'label' => 'Главная',
									'url' => ['/main/backend/default/index'],
								],
								'links' => isset($this->params['breadcrumbs'])? $this->params['breadcrumbs'] : [],
			          'activeItemTemplate' => "<li class=\"active\"><!--noindex-->{link}<!--/noindex--></li>",
							]);?>
							<?= Alert::widget();?>
							<?php if (isset($this->params['pageHeader'])) :?>
								<div class="page-header">
									<h3><?php echo $this->params['pageHeader'];?></h3>
								</div> 	
							<?php endif;?>
							<?php 
								if (isset($this->params['toolbar'])) {
									echo Menu::widget([
										'options' => ['class' => 'list-inline'],
										'encodeLabels' => false,
										'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
										'items' => $this->params['toolbar'],
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