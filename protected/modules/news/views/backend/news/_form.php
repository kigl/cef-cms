<?php
use Yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
use yii\bootstrap\Collapse;
use vova07\imperavi\Widget;
use app\modules\news\models\News;
?>

<?php $form = ActiveForm::begin([
        'id' => 'form',
        'enableClientValidation' => false,
        'fieldConfig' => [
            'template' => "{label}{input}",
        ],
    ]);?>
<?php echo $form->errorSummary($model, ['class' => 'alert alert-danger'])?>
<?php if ($model->imageExist()) :?>
	<div class="img-thumbnail">
		<div>
			<label class="pull-right">Удалить
				<input type="checkbox" name="deleteFile"/>
			</label>
		</div>
		<?php echo Html::img($model->getFileUrl());?>
	</div>
<?php endif;?>
<?php echo $form->field($model, 'image_preview')->fileInput();?>
<div class="row">
    <div class="col-md-4">
        <?php echo $form->field($model, 'date')->widget(DatePicker::className(), [
                'options' => [
                    'class' => 'form-control'
                ],
            ]
        );?>
    </div>
    <div class="col-md-8">
        <?php echo $form->field($model, 'status')->dropDownList(News::getStatusList());?>
    </div>
</div>
<?php echo $form->field($model, 'title');?>
<?php echo $form->field($model, 'short_description')->textArea();?>
<?php echo $form->field($model, 'content')->widget(Widget::className(), [
        'settings' => [
            'lang' => 'ru',
            'minHeight' => 400,
            'imageManagerJson' => Url::to(['/news/backend/news/images-get']),
            'imageUpload' => Url::to(['/news/backend/news/image-upload']),
            'plugins' => [
                'imagemanager',
                'clips',
                'fullscreen',
            ],
        ],
    ]);?>
<?php echo Collapse::widget([
        'items' => [
            [
                'label' => Yii::t('main', 'form seo'),
                'content' => [
                    $form->field($model, 'meta_title'),
                    $form->field($model, 'meta_description'),
                ],]]
    ]);
?>
<?php ActiveForm::end();?>