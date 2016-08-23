<?php
$this->breadcrumbs = [
	['label' => 'Пользователи', 'url' => ['manager']],
	['label' => 'Создание'],
];

$this->toolbar = [
	['label' => '<button form="form" class="btn btn-success btn-sm">'. Yii::t('main', 'button save') . '</button>'],
];
?>
<?php echo $this->render('_form', ['model' => $model]);?>


