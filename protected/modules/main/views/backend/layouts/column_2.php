<?php 
use yii\widgets\Menu;
use app\modules\main\widgets\Breadcrumbs;
use app\modules\main\widgets\Alert;
use app\modules\main\widgets\adminMenuLeft\Widget as MenuLeft;
use app\modules\main\widgets\adminMenuTop\Widget as MenuTop;
?>
<?php $this->beginContent('@app/modules/main/views/backend/layouts/index.php');?>
<div class="row">
	<div class="col-md-2 sidebar padding-left-5">
		<div style="height: 100px; border: 1px solid black">Avatar</div>
		<?php echo MenuLeft::widget();?>
	</div>
	<div class="col-md-10 blackboard no-padding">
		<div class="row">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-12">
						<div class="top">
							<?php echo MenuTop::widget();?>
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