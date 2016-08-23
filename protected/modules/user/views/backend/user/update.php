<?php
$this->breadcrumbs = [
	['label' => 'Пользователи', 'url' => ['manager']],
	['label' => 'Редактирование'],
];

$this->toolbar = [
	['label' => '<button form="form" class="btn btn-success btn-sm">'. Yii::t('main', 'button save') . '</button>'],
	['label' => 'Изменить пароль', 'url' => ['password', 'id' => $model->id]],
];
?>
<?php echo $this->render('_form', ['model' => $model]);?>