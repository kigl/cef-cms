<?php
use yii\helpers\Html;
use app\modules\site\Module;

$message = Module::t('Update template: {id}', ['id' => Html::encode($model->id)]);

$this->setTitle($message);
$this->setPageHeader($message);
$this->params['breadcrumbs'][] = ['label' => Module::t('Templates'), 'url' => ['manager']];

echo $this->render('_form', ['model' => $model]);