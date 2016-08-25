<?php
$this->breadcrumbs = [
	['label' => 'Новости', 'url' => ['manager']],
	['label' => Yii::t('main', 'breadcrumbs add'), 'url' => ['create']],
];
?>

<div class="well well-sm">
	<?php echo $this->render('_form', ['model' => $model]);?>
</div>