<?php
use yii\widgets\Menu;
use yii\widgets\Breadcrumbs;
use app\modules\main\widgets\backend\Alert;
use app\modules\main\widgets\frontend\topNavBar\Widget as TopBar;
?>

<?php $this->beginContent('@app/modules/main/views/layouts/main.php');?>
<div class="row row__wrapper">
	<div class="col-md-3 col-lg-3 col__wrapper padding-left-0">
		<div class="sidebar">
			<div class="logo">
				<img src="/public/images/template/logo.png"/>
			</div>
			<?= Menu::widget([
						'encodeLabels' => false,
						'options' => ['class' => 'sidebar__menu list-group'],
						'itemOptions' => ['class' => 'list-group-item'],
						'activateItems' => false,
						'items' => [
							['label' => '<i class="fa fa-newspaper-o"></i> Новости', 'url' => ['/informationsystem/news/manager']],
							['label' => '<i class="fa fa-video-camera"></i> Видео', 'url' => ['/informationsystem/video/manager']],
							['label' => '<i class="fa fa-picture-o"></i> Изображения', 'url' => ['/informationsystem/image/manager']],
							['label' => '<i class="fa fa-lightbulb-o"></i> Жалобы и предложения', 'url' => ['/informationsystem/offers/manager']],
							['label' => '<i class="fa fa-weixin"></i> Форум', 'url' => ['/forum/default/index']],
						],
			]);?>
		</div>
	</div>
	<div class="col-md-9 col-lg-9">
		<div>
			<?= TopBar::widget();?>
		</div>
		<?php  echo Breadcrumbs::widget([
			'homeLink' => [
				'label' => 'Главная',
				'url' => ['/site/index'],
			],
			'links' => isset($this->params['breadcrumbs'])? $this->params['breadcrumbs'] : [],
      'activeItemTemplate' => "<li class=\"active\"><!--noindex-->{link}<!--/noindex--></li>",
		]);?>
		<?= Alert::widget();?>
		<div>
			<?php 
				if (isset($this->params['actionBar'])) {
					echo Menu::widget([
									'items' => $this->params['actionBar'],
									'options' => ['class' => 'list-inline'],
									'encodeLabels' => false,
									'linkTemplate' => '<a href="{url}" class="btn btn-default btn-sm">{label}</a>',
					]);
				}
			?>
		</div>
		<?= $content;?>
	</div>
</div>
<?php $this->endContent();?>