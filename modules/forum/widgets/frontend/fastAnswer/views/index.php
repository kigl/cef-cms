<?php
use app\modules\main\widgets\backend\ActiveForm;
?>

<div class="panel panel-primary">
	<div class="panel-heading"><?= Yii::t('forum', 'Fast answer')?></div>
	<div class="panel-body">
	<?php $form = ActiveForm::begin(['options' => ['data-pjax' => 1]]);?>

	<?php if ($message != '') :?>
		<div class="alert alert-success">
			<?= $message;?>
		</div>
	<?php endif;?>
	<?= $form->errorSummary($model);?>

	<?= $form->field($model, 'topic_id')->hiddenInput(['value' => $topicId])->label(false);?>

	<?= $form->field($model, 'content')->textArea();?>

	<?php ActiveForm::end();?>
	</div>
</div>