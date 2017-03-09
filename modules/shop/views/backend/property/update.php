<?php
use app\modules\shop\Module;

$this->setTitle(Module::t('Edit product property: {data}', ['data' => $model->name]));
$this->setPageHeader(Module::t('Edit product property: {data}', ['data' => $model->name]));
$this->params['breadcrumbs'][] = ['label' => Module::t('Product properties'), 'url' => ['property/manager']];
$this->params['breadcrumbs'][] = ['label' => $model->name];

echo $this->render('_form', ['model' => $model]);?>