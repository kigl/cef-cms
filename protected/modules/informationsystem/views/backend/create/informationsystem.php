<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\main\widgets\activeForm\ActiveForm;
use vova07\imperavi\Widget;
?>

<?php $form = ActiveForm::begin();?>
	<?php echo $form->field($model, 'name');?>
	<div class="row">
		<div class="col-md-6">
			<?php echo $form->field($model, 'image');?>
		</div>
		<div class="col-md-6">
			<?php echo $form->field($model, 'status')->dropDownList([]);?>
		</div>
	</div>
	<?php echo $form->field($model, 'description')->textArea();?>
	<?php echo $form->field($model, 'content')->widget(Widget::className(), [
			'settings' => [
				'lang' => 'ru',
				'minHeight' => 400,
			],
	]);?>
	
	<?php echo Html::a(Yii::t('main', 'seo fields'), Url::to('#seo'), ['data-toggle' => 'collapse']);?>
	<div class="collapse" id="seo">
		<?php echo $form->field($model, 'seo_title');?>
		<?php echo $form->field($model, 'seo_description');?>
	</div>
<?php ActiveForm::end();?>