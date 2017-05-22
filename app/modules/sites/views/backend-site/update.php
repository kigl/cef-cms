<?php
use app\modules\sites\Module;
use yii\helpers\Html;

$messageUpdate = Module::t('Update site: {domain}', ['domain' => $model->domain]);

$this->setTitle($messageUpdate);
$this->setPageHeader($messageUpdate);
$this->params['breadcrumbs'][] = ['label' => Module::t('Sites'), 'url' => 'manager'];
$this->params['breadcrumbs'][] = ['label' => Html::encode($model->domain)];

echo $this->render('_form', ['model' => $model]);