<?php
use yii\helpers\Url;
use app\modules\backend\widgets\ActiveForm;
use vova07\imperavi\Widget as Imperavi;
?>

<?php $form = ActiveForm::begin();?>

<?= $form->errorSummary($model);?>

<?= $form->field($model, 'name');?>

<?= $form->field($model, 'content')
			->widget(Imperavi::className(), [
				'settings' => [
					'minHeight' => 400,
	        'imageManagerJson' => Url::to(['/page/backend/default/images-get']),
	        'imageUpload' => Url::to(['/page/backend/default/image-upload']),
	        'plugins' => [
	            'imagemanager',
	            'fullscreen',
	        ]
				]
			]);?>

<?= $form->field($model, 'viewFile')->textarea();?>

<?= $form->field($model, 'alias');?>

<?= $form->field($model, 'meta_title');?>

<?= $form->field($model, 'meta_description');?>

<?php ActiveForm::end();?>
