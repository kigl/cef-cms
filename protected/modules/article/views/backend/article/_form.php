<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use vova07\imperavi\Widget;

/* @var $this yii\web\View */
/* @var $model app\modules\page\models\Page */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
  <div class="col-md-12">
    <div class="page-form">
      <?php $form = ActiveForm::begin(['id' => 'form']); ?>

      <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
      
      <?= $form->field($model, 'content')->widget(Widget::className(), [
      	'settings' => [
      		'lang' => 'ru',
      		'minHeight' => 400,
      		'imageManagerJson' => Url::to(['/page/backend/page/images-get']),
      		'imageUpload' => Url::to(['/page/backend/page/image-upload']),
      		'plugins' => [
      			'imagemanager',
      			'clips',
      			'fullscreen',
      		],
      	],
      ]); ?>
      
      
      <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

      <div class="panel panel-default">
          <div class="panel-heading">
              <a data-toggle="collapse" href="#seo"><?php echo Yii::t('main', 'seo info');?></a>
          </div>
          <div class="panel-body collapse" id="seo">
              <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

              <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>
          </div>
      </div>
      <div class="panel-footer">
      	<?php echo Html::submitButton(Yii::t('main', 'button save'), ['class' => 'btn btn-success btn-sm'])?>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>
</div>
