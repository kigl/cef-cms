<?php
$this->breadcrumbs = [
	['label' => 'Пользователи', 'url' => ['manager']],
	['label' => 'Редактирование'],
];

$this->toolbar = [
	['label' => 'Изменить пароль', 'url' => ['password', 'id' => $model->id]],
];
?>
<?php echo $this->render('_form', ['model' => $model]);?>