<?php
use yii\widgets\Menu;
use app\modules\main\widgets\adminMenuLeft\assets\Asset;

Asset::register($this);

?>
<div class="admin left-menu">
	<?php
	echo Menu::widget([
		'options' => ['class' => 'nav nav-pills nav-stacked'],
		'items' => $module,
	]);
	?>
</div>