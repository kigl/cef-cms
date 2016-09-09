<?php 
$this->params['breadcrumbs'] = [
	['label' => 'Модули', 'url' => ['manager']],
	['label' => 'Редактирование'],
];
?>

<div class="well well-sm">
	<?php echo $this->render('_form', ['model' => $model]);?>
</div>