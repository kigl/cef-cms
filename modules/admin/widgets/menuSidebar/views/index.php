<?php
use yii\widgets\Menu;

?>
<div class="admin left-menu">
	<?php
	echo Menu::widget([
		'options' => ['class' => 'nav nav-pills nav-stacked'],
		'items' => $module,
	]);
	?>
</div>