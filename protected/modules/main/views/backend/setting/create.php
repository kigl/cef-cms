<?php 
$this->breadcrumbs = [
	['label' => 'Настройки', 'url' => ['manager']],
	['label' => 'Создание'],
];
?>

<div class="well well-sm">
	<?php echo $this->render('_form', ['model' => $model]);?>
</div>