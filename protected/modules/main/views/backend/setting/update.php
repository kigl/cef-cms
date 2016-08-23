<?php 
$this->breadcrumbs = [
	['label' => 'Настройки', 'url' => ['manager']],
	['label' => 'Редактирование'],
];

$this->toolbar = [
	['label' => '<button form="form" class="btn btn-success btn-sm">'.Yii::t('main', 'button save').'</button>'],
];
?>

<div class="well well-sm">
	<?php echo $this->render('_form', ['model' => $model]);?>
</div>