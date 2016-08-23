<?php
$this->breadcrumbs = [
	['label' => 'Новости', 'url' => ['manager']],
	['label' => Yii::t('main', 'breadcrumbs add'), 'url' => ['create']],
];

$this->toolbar = [
	['label' => '<button form="form" class="btn btn-success btn-sm">'. Yii::t('main', 'button save')],
];
?>

<div class="well well-sm">
	<?php echo $this->render('_form', ['model' => $model]);?>
</div>