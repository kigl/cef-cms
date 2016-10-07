<?php 
use yii\widgets\Menu;
use app\modules\main\widgets\backend\Breadcrumbs;
use app\modules\main\widgets\backend\Alert;
use app\modules\main\widgets\backend\menuSidebar\Widget as MenuSidebar;
use app\modules\main\widgets\backend\menuTop\Widget as MenuTop;
?>
<?php $this->beginContent('@app/modules/main/views/backend/layouts/index.php');?>
<div class="row">
	<div class="col-md-2 sidebar padding-left-5">
		<?= MenuSidebar::widget();?>
	</div>
	<div class="col-md-10 blackboard no-padding">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="top">
							<?= MenuTop::widget();?>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="content">
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
					<?= $content;?>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->endContent();?>