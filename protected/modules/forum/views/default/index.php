<?php
use app\modules\forum\widgets\frontend\dashboard\Widget as Dashboard;

$this->params['breadcrumbs'] = $breadcrumbs;
?>

<div class="bg-content">
	<?= Dashboard::widget();?>
</div>