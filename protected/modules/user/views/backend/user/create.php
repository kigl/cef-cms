<?php
$this->breadcrumbs = [
	['label' => 'Пользователи', 'url' => ['manager']],
	['label' => 'Создание'],
];
?>
<?php echo $this->render('_form', ['model' => $model]);?>


